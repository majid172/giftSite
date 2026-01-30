<?php

namespace App\Jobs;

use App\Mail\ContactFormSubmitted;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;

class SendContactEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $validatedData;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($validatedData)
    {
        $this->validatedData = $validatedData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Settings are now synced to .env, so we can rely on standard Config
        // We still fetch the admin email from DB settings though
        $adminEmail = $this->getSetting('contact_email');

        if ($adminEmail) {
            try {
                Mail::to($adminEmail)->send(new ContactFormSubmitted($this->validatedData));
            } catch (\Exception $e) {
                Log::error('Queue: Contact form email failed: ' . $e->getMessage());
            }
        }
    }

    protected function getSetting($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}
