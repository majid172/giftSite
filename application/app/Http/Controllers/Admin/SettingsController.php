<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Update global settings
     */
    public function update(Request $request)
    {
        // Validation

        $validator = Validator::make($request->all(), [

            // General
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_motto' => ['nullable', 'string', 'max:255'],
            'site_description' => ['nullable', 'string'],

            // Contact
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_address' => ['nullable', 'string', 'max:500'],

            // Files
            'site_favicon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,ico,webp', 'max:2048'],
            'hero_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'about_banner_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],

            // Media
            'media_max_size' => ['nullable', 'numeric', 'min:100', 'max:10240'],
            'media_allowed_types' => ['nullable', 'string', 'max:255'],

            // SEO
            'seo_meta_title' => ['nullable', 'string', 'max:255'],
            'seo_meta_keywords' => ['nullable', 'string', 'max:500'],
            'seo_meta_description' => ['nullable', 'string', 'max:500'],
            'seo_analytics_id' => ['nullable', 'string', 'max:255'],
            'seo_pixel_id' => ['nullable', 'regex:/^[0-9]+$/'],

            // Email
            'mail_host' => ['nullable', 'string', 'max:255'],
            'mail_port' => ['nullable', 'numeric'],
            'mail_username' => ['nullable', 'string', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_encryption' => ['nullable', 'in:tls,ssl,null'],
            'mail_from_address' => ['nullable', 'email', 'max:255'],
            'mail_from_name' => ['nullable', 'string', 'max:255'],
        ], [

            // Custom messages
            'seo_pixel_id.regex' => 'Meta Pixel ID must contain digits only.',
            'contact_email.email' => 'Please enter a valid contact email.',
            'mail_from_address.email' => 'Mail from address must be a valid email.',
            'site_favicon.image' => 'Favicon must be an image.',
            'hero_image.image' => 'Hero image must be an image file.',
            'about_banner_image.image' => 'About banner must be an image file.',
            'media_max_size.numeric' => 'Max upload size must be a number.',
            'mail_port.numeric' => 'Mail port must be numeric.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();        }



        // Handle checkboxes (unchecked checkbox not sent in request)
        $data = $request->except(['_token', '_method']);

        $data['maintenance_mode'] = $request->has('maintenance_mode') ? '1' : '0';
        $data['enable_pixel'] = $request->has('enable_pixel') ? '1' : '0';

        // JSON storage for frontend content
        $frontendData = [];
        $jsonPath = storage_path('app/frontend_settings.json');
        if (file_exists($jsonPath)) {
            $frontendData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        foreach ($data as $key => $value) {

            // File Upload Handling
            if ($request->hasFile($key)) {
                $file = $request->file($key);

                // Folder based on key prefix
                $parts = explode('_', $key);
                $folderName = count($parts) > 1 ? $parts[0] : 'others';

                $destinationPath = base_path('../assets/images/' . $folderName);

                // Create folder if not exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Unique filename
                $filename = time() . '_' . $file->getClientOriginalName();

                // Delete old file
                $oldValue = get_setting($key);
                $oldFilePath = base_path('../' . $oldValue);

                if ($oldValue && file_exists($oldFilePath) && is_file($oldFilePath)) {
                    try {
                        unlink($oldFilePath);
                    }
                    catch (\Exception $e) {
                    // Optional: log error
                    }
                }

                // Move new file
                $file->move($destinationPath, $filename);

                // Save relative path
                $value = 'assets/images/' . $folderName . '/' . $filename;
            }

            // Intercept frontend keys to save in JSON instead of DB
            if (strpos($key, 'about_') === 0) {
                $frontendData[$key] = $value;
                continue;
            }

            // Save setting
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Save updated frontend data to JSON
        file_put_contents($jsonPath, json_encode($frontendData, JSON_PRETTY_PRINT));

        // Sync Mail + Pixel settings to .env
        $this->updateEnv([
            'MAIL_HOST' => $request->input('mail_host'),
            'MAIL_PORT' => $request->input('mail_port'),
            'MAIL_USERNAME' => $request->input('mail_username'),
            'MAIL_PASSWORD' => $request->input('mail_password'),
            'MAIL_ENCRYPTION' => $request->input('mail_encryption'),
            'MAIL_FROM_ADDRESS' => $request->input('mail_from_address'),
            'MAIL_FROM_NAME' => $request->input('mail_from_name'),
            'META_PIXEL_ID' => $request->input('seo_pixel_id'),
        ]);

        return redirect()->back()->with('success', 'Global settings updated successfully.');
    }

    /**
     * Update values in .env file
     */
    private function updateEnv(array $data)
    {
        $path = base_path('.env');

        if (!file_exists($path)) {
            return;
        }

        $env = file_get_contents($path);

        foreach ($data as $key => $value) {

            if ($value === null) {
                continue;
            }

            // Wrap value with quotes if it contains spaces
            if (strpos($value, ' ') !== false && strpos($value, '"') === false) {
                $value = '"' . $value . '"';
            }

            // Replace existing key
            if (preg_match("/^{$key}=.*/m", $env)) {
                $env = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $env);
            }
            else {
                $env .= "\n{$key}={$value}";
            }
        }

        file_put_contents($path, $env);
    }
}
