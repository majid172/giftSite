<?php

namespace App\Http\Traits;

use Illuminate\Http\UploadedFile;

trait ImageResizer
{
    /**
     * Resize AND center-crop an uploaded image to EXACT target dimensions.
     *
     * Use this when you need a guaranteed W×H output (e.g. 800×600 for product cards).
     * The image is scaled so the smaller dimension fills the target, then the excess
     * of the larger dimension is cropped from the center — same as CSS object-cover.
     *
     * @param  UploadedFile  $file
     * @param  string        $destinationDir  Absolute directory path (no trailing slash)
     * @param  int           $targetWidth     Exact output width  in pixels
     * @param  int           $targetHeight    Exact output height in pixels
     * @param  int           $quality         JPEG/WEBP quality 1–100
     * @return string        Filename saved inside $destinationDir
     */
    protected function resizeAndCrop(
        UploadedFile $file,
        string $destinationDir,
        int $targetWidth  = 800,
        int $targetHeight = 600,
        int $quality      = 85
    ): string {
        if (!file_exists($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        $extension  = strtolower($file->getClientOriginalExtension());
        $fileName   = time() . '_' . uniqid() . '.' . $extension;
        $destPath   = $destinationDir . '/' . $fileName;
        $sourcePath = $file->getPathname();

        // Non-raster types — copy as-is
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            copy($sourcePath, $destPath);
            return $fileName;
        }

        $info = @getimagesize($sourcePath);
        if (!$info) {
            copy($sourcePath, $destPath);
            return $fileName;
        }

        [$srcWidth, $srcHeight, $type] = $info;

        // --- Scale so the image COVERS the target (like object-cover) ---
        $scaleW = $targetWidth  / $srcWidth;
        $scaleH = $targetHeight / $srcHeight;
        $scale  = max($scaleW, $scaleH); // use the larger scale so both dims are >= target

        $scaledW = (int) round($srcWidth  * $scale);
        $scaledH = (int) round($srcHeight * $scale);

        // Center-crop offsets
        $cropX = (int) round(($scaledW - $targetWidth)  / 2);
        $cropY = (int) round(($scaledH - $targetHeight) / 2);

        // Load source
        $source = match ($type) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($sourcePath),
            IMAGETYPE_PNG  => imagecreatefrompng($sourcePath),
            IMAGETYPE_GIF  => imagecreatefromgif($sourcePath),
            IMAGETYPE_WEBP => imagecreatefromwebp($sourcePath),
            default        => null,
        };

        if (!$source) {
            copy($sourcePath, $destPath);
            return $fileName;
        }

        // Canvas at exact target size
        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);

        if (in_array($type, [IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP])) {
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
            imagefilledrectangle($canvas, 0, 0, $targetWidth, $targetHeight,
                imagecolorallocatealpha($canvas, 0, 0, 0, 127));
        } else {
            imagefilledrectangle($canvas, 0, 0, $targetWidth, $targetHeight,
                imagecolorallocate($canvas, 255, 255, 255));
        }

        // Scale source into a temporary full-scaled image, then crop
        $scaled = imagecreatetruecolor($scaledW, $scaledH);
        imagecopyresampled($scaled, $source, 0, 0, 0, 0, $scaledW, $scaledH, $srcWidth, $srcHeight);

        // Crop the center portion into the canvas
        imagecopy($canvas, $scaled, 0, 0, $cropX, $cropY, $targetWidth, $targetHeight);

        $pngCompression = (int) max(0, min(9, round((100 - $quality) / 11)));

        match ($type) {
            IMAGETYPE_JPEG => imagejpeg($canvas, $destPath, $quality),
            IMAGETYPE_PNG  => imagepng($canvas, $destPath, $pngCompression),
            IMAGETYPE_GIF  => imagegif($canvas, $destPath),
            IMAGETYPE_WEBP => imagewebp($canvas, $destPath, $quality),
            default        => copy($sourcePath, $destPath),
        };

        imagedestroy($canvas);
        imagedestroy($scaled);
        imagedestroy($source);

        return $fileName;
    }

    /**
     * Resize (if needed) and re-encode an uploaded image, then save it.
     *
     * Always re-encodes through GD so that quality/compression is applied
     * even when the image is already within the max dimensions.
     * Preserves aspect ratio, never upscales, handles PNG/GIF/WEBP transparency.
     * Falls back to a plain file copy for SVG or unsupported types.
     *
     * @param  UploadedFile  $file
     * @param  string        $destinationDir  Absolute directory path (no trailing slash)
     * @param  int           $maxWidth        Maximum output width  in pixels (default 900)
     * @param  int           $maxHeight       Maximum output height in pixels (default 900)
     * @param  int           $quality         JPEG/WEBP quality 1–100 (PNG is derived automatically)
     * @return string        Filename saved inside $destinationDir
     */
    protected function resizeAndSave(
        UploadedFile $file,
        string $destinationDir,
        int $maxWidth  = 900,
        int $maxHeight = 900,
        int $quality   = 85
    ): string {
        // Ensure target directory exists
        if (!file_exists($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }

        $extension  = strtolower($file->getClientOriginalExtension());
        $fileName   = time() . '_' . uniqid() . '.' . $extension;
        $destPath   = $destinationDir . '/' . $fileName;
        $sourcePath = $file->getPathname();

        // SVG and non-raster types – copy as-is (GD cannot process them)
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            copy($sourcePath, $destPath);
            return $fileName;
        }

        // Read image dimensions and type
        $info = @getimagesize($sourcePath);
        if (!$info) {
            // Not a valid raster image – copy raw
            copy($sourcePath, $destPath);
            return $fileName;
        }

        [$srcWidth, $srcHeight, $type] = $info;

        // --- Calculate output dimensions (never upscale) ---
        $newWidth  = $srcWidth;
        $newHeight = $srcHeight;

        if ($srcWidth > $maxWidth || $srcHeight > $maxHeight) {
            $ratio = $srcWidth / $srcHeight;

            if ($maxWidth / $maxHeight > $ratio) {
                // Height is the limiting side
                $newHeight = $maxHeight;
                $newWidth  = (int) round($maxHeight * $ratio);
            } else {
                // Width is the limiting side
                $newWidth  = $maxWidth;
                $newHeight = (int) round($maxWidth / $ratio);
            }
        }

        // --- Load source image ---
        $source = match ($type) {
            IMAGETYPE_JPEG => imagecreatefromjpeg($sourcePath),
            IMAGETYPE_PNG  => imagecreatefrompng($sourcePath),
            IMAGETYPE_GIF  => imagecreatefromgif($sourcePath),
            IMAGETYPE_WEBP => imagecreatefromwebp($sourcePath),
            default        => null,
        };

        if (!$source) {
            // GD couldn't load it – copy raw
            copy($sourcePath, $destPath);
            return $fileName;
        }

        // --- Create output canvas ---
        $canvas = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for PNG, GIF, WEBP
        if (in_array($type, [IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP])) {
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
            $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
            imagefilledrectangle($canvas, 0, 0, $newWidth, $newHeight, $transparent);
        } else {
            // Fill JPEG canvas with white (no transparency)
            $white = imagecolorallocate($canvas, 255, 255, 255);
            imagefilledrectangle($canvas, 0, 0, $newWidth, $newHeight, $white);
        }

        // Resample (high-quality resize)
        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $newWidth, $newHeight, $srcWidth, $srcHeight);

        // --- Save re-encoded output ---
        // PNG compression: 0 = none, 9 = maximum. We derive it from quality.
        $pngCompression = (int) max(0, min(9, round((100 - $quality) / 11)));

        match ($type) {
            IMAGETYPE_JPEG => imagejpeg($canvas, $destPath, $quality),
            IMAGETYPE_PNG  => imagepng($canvas, $destPath, $pngCompression),
            IMAGETYPE_GIF  => imagegif($canvas, $destPath),
            IMAGETYPE_WEBP => imagewebp($canvas, $destPath, $quality),
            default        => copy($sourcePath, $destPath),
        };

        imagedestroy($canvas);
        imagedestroy($source);

        return $fileName;
    }
}
