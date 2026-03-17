<?php

use Carbon\Carbon;

if (!function_exists('dateFormat')) {

    function dateFormat($date, $format = 'd M, Y') {
        if (!$date) {
            return 'N/A';
        }
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('numberFormat')) {

    function numberFormat($number, $decimals = 2) {
        return number_format((float)$number, $decimals);
    }
}

if (!function_exists('get_setting')) {

    function get_setting($key, $default = null) {
        static $settings;

        if (is_null($settings)) {
            $settings = \App\Models\Setting::pluck('value', 'key')->toArray();

            $jsonPath = storage_path('app/frontend_settings.json');
            if (file_exists($jsonPath)) {
                $jsonSettings = json_decode(file_get_contents($jsonPath), true);
                if (is_array($jsonSettings)) {
                    $settings = array_merge($settings, $jsonSettings);
                }
            }
        }

        return $settings[$key] ?? $default;
    }
}

if (!function_exists('calculate_discount')) {
    function calculate_discount($price, $old_price) {
        if ($old_price > 0 && $price < $old_price) {
            return round((($old_price - $price) / $old_price) * 100);
        }
        return 0;
    }
}
