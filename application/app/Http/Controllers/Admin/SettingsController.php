<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Handle checkboxes that might not be sent if unchecked
        $data = $request->except(['_token', '_method']);
        
        // Explicitly handle boolean toggles
        $data['maintenance_mode'] = $request->has('maintenance_mode') ? '1' : '0';
        $data['enable_pixel'] = $request->has('enable_pixel') ? '1' : '0';

        // JSON storage for frontend content
        $frontendData = [];
        $jsonPath = storage_path('app/frontend_settings.json');
        if (file_exists($jsonPath)) {
            $frontendData = json_decode(file_get_contents($jsonPath), true) ?? [];
        }

        foreach ($data as $key => $value) {
            // Check if specifically handled as file
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                
                // Determine folder based on key prefix (typename)
                $parts = explode('_', $key);
                $folderName = count($parts) > 1 ? $parts[0] : 'others';
                
                // Construct target path
                $destinationPath = base_path('../assets/images/' . $folderName);
                
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Remove old file if exists
                $oldValue = get_setting($key);
                $oldFilePath = base_path('../' . $oldValue);
                if ($oldValue && file_exists($oldFilePath) && is_file($oldFilePath)) {
                    try {
                        unlink($oldFilePath);
                    } catch (\Exception $e) {}
                }

                $file->move($destinationPath, $filename);
                $value = 'assets/images/' . $folderName . '/' . $filename;
            }

            // Intercept frontend keys to save in JSON instead of DB
            if (strpos($key, 'about_') === 0) {
                $frontendData[$key] = $value;
                continue;
            }

            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Save updated frontend data to JSON
        file_put_contents($jsonPath, json_encode($frontendData, JSON_PRETTY_PRINT));

        // Sync Mail Settings to .env
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

        return redirect()->back()->with('success', 'Global settings updated with JSON precision.');
    }

    /**
     * Update .env file with given key-value pairs.
     *
     * @param array $data
     * @return void
     */
    private function updateEnv(array $data)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $env = file_get_contents($path);

            foreach ($data as $key => $value) {
                if ($value !== null) {
                    // Wrap strings with spaces in quotes
                    if (strpos($value, ' ') !== false && strpos($value, '"') === false) {
                        $value = '"' . $value . '"';
                    }

                    // Check if key exists
                    if (strpos($env, $key . '=') !== false) {
                        // Replace existing key
                        $env = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $env);
                    } else {
                        // Append new key
                        $env .= "\n{$key}={$value}";
                    }
                }
            }

            file_put_contents($path, $env);
        }
    }
}
