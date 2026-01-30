<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:' . config('settings.media_max_size', 2048),
            'others' => 'nullable|array',
            'others.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:' . config('settings.media_max_size', 2048),
        ]);

        // Slug
        $slug = Str::slug($request->name);
        $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        // Create product first
        $data = $request->except(['image', 'others']);
        $data['slug'] = $slug;
        $data['description'] = $request->description;

        // Base upload path
        $destinationPath = base_path('../assets/images/product');

        // Ensure directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        // Store main image with resizing
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Resize and save
            $this->resizeImage($file, $destinationPath . '/' . $fileName, 800, 800);

            $data['image'] = 'assets/images/product/' . $fileName;
        }

        $product = Product::create($data);

        // Store gallery images with resizing
        if ($request->hasFile('others')) {
            foreach ($request->file('others') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Resize and save
                $this->resizeImage($file, $destinationPath . '/' . $fileName, 800, 800);

                $product->images()->create([
                    'image_path' => 'assets/images/product/' . $fileName,
                    'is_primary' => 0,
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'badge' => 'nullable|string|max:50',
            'badge_color' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:' . config('settings.media_max_size', 2048),
            'others' => 'nullable|array',
            'others.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:' . config('settings.media_max_size', 2048),
        ]);

        $data = $request->except(['image', 'others']);
        
        // Update slug if name changes
        if ($request->name !== $product->name) {
             $slug = Str::slug($request->name);
             $count = Product::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $product->id)->count();
             if ($count > 0) {
                  $slug .= '-' . ($count + 1);
             }
             $data['slug'] = $slug;
        }

        $destinationPath = base_path('../assets/images/product');

        // Ensure directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        if ($request->hasFile('image')) {
            // Delete old primary image if it exists
            if ($product->image) {
                $oldImagePath = base_path('../' . $product->image);
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }
            
            $file = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Resize and save
            $this->resizeImage($file, $destinationPath . '/' . $fileName, 800, 800);
            
            $data['image'] = 'assets/images/product/' . $fileName;
        }

        $product->update($data);

        // Store gallery images
        if ($request->hasFile('others')) {
            foreach ($request->file('others') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                
                // Resize and save
                $this->resizeImage($file, $destinationPath . '/' . $fileName, 800, 800);

                $product->images()->create([
                    'image_path' => 'assets/images/product/' . $fileName,
                    'is_primary' => 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Native PHP Image Resizer
     */
    private function resizeImage($file, $destination, $maxWidth, $maxHeight)
    {
        list($width, $height, $type) = getimagesize($file->getPathname());
        
        $ratio = $width / $height;
        if ($maxWidth / $maxHeight > $ratio) {
            $maxWidth = $maxHeight * $ratio;
        } else {
            $maxHeight = $maxWidth / $ratio;
        }

        $newWidth = (int)$maxWidth;
        $newHeight = (int)$maxHeight;

        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        
        // Handle transparency for PNG and GIF
        if ($type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF) {
            imagecolortransparent($thumb, imagecolorallocatealpha($thumb, 0, 0, 0, 127));
            imagealphablending($thumb, false);
            imagesavealpha($thumb, true);
        }

        switch ($type) {
            case IMAGETYPE_JPEG:
                $source = imagecreatefromjpeg($file->getPathname());
                break;
            case IMAGETYPE_PNG:
                $source = imagecreatefrompng($file->getPathname());
                break;
            case IMAGETYPE_GIF:
                $source = imagecreatefromgif($file->getPathname());
                break;
            default:
                // Fallback for others or if not supported, just move file
                 move_uploaded_file($file->getPathname(), $destination);
                return;
        }

        imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        switch ($type) {
            case IMAGETYPE_JPEG:
                imagejpeg($thumb, $destination, 90);
                break;
            case IMAGETYPE_PNG:
                imagepng($thumb, $destination, 9);
                break;
            case IMAGETYPE_GIF:
                imagegif($thumb, $destination);
                break;
        }

        imagedestroy($thumb);
        imagedestroy($source);
    }

    /**
     * Remove individual product image from gallery.
     */
    public function destroyImage($id)
    {
        $image = \App\Models\ProductImage::findOrFail($id);
        
        // Delete file
        $filePath = base_path('../' . $image->image_path);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        
        $image->delete();

        return response()->json(['success' => true, 'message' => 'Image removed successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete primary image
        if ($product->image) {
            $imagePath = base_path('../' . $product->image);
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }
        }

        // Delete gallery images
        foreach($product->images as $image) {
            $galleryPath = base_path('../' . $image->image_path);
            if (file_exists($galleryPath)) {
                @unlink($galleryPath);
            }
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
