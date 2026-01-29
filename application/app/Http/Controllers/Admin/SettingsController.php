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
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            // Check if specifically handled as file
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                
                // Determine folder based on key prefix (typename)
                // e.g., site_favicon -> site, seo_social_image -> seo
                $parts = explode('_', $key);
                $folderName = count($parts) > 1 ? $parts[0] : 'others';
                
                // Construct target path: ../assets/images/{typename}
                // User requested to use root directory assets, which is one level up from application
                $destinationPath = base_path('../assets/images/' . $folderName);
                
                // Ensure directory exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Generate unique filename
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Remove old file if exists
                $oldValue = get_setting($key);
                // Check if old value is not empty and file exists in root assets path
                $oldFilePath = base_path('../' . $oldValue);
                if ($oldValue && file_exists($oldFilePath) && is_file($oldFilePath)) {
                    try {
                        unlink($oldFilePath);
                    } catch (\Exception $e) {
                         // Ignore deletion errors or log them
                    }
                }

                // Move new file to root assets directory
                $file->move($destinationPath, $filename);
                
                // Store relative path (same as before, assuming webserver serves root assets)
                $value = 'assets/images/' . $folderName . '/' . $filename;
            }

            // Optimization: Only update if value changed (optional but cleaner)
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->back()->with('success', 'Global settings updated with heritage precision.');
    }
}
