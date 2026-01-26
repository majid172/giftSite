<?php

use Carbon\Carbon;

if (!function_exists('dateFormat')) {
    /**
     * Format a date.
     *
     * @param mixed $date
     * @param string $format
     * @return string
     */
    function dateFormat($date, $format = 'd M, Y') {
        if (!$date) {
            return 'N/A';
        }
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('numberFormat')) {
    /**
     * Format a number.
     *
     * @param mixed $number
     * @param int $decimals
     * @return string
     */
    function numberFormat($number, $decimals = 2) {
        return number_format((float)$number, $decimals);
    }
}

if (!function_exists('get_setting')) {
    /**
     * Get a setting value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function get_setting($key, $default = null) {
        $setting = \App\Models\Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}
