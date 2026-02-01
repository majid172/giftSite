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
        static $settings;

        if (is_null($settings)) {
            $settings = \App\Models\Setting::pluck('value', 'key')->toArray();
        }

        return $settings[$key] ?? $default;
    }
}

if (!function_exists('calculate_discount')) {
    /**
     * Calculate discount percentage.
     *
     * @param float $price
     * @param float $old_price
     * @return int
     */
    function calculate_discount($price, $old_price) {
        if ($old_price > 0 && $price < $old_price) {
            return round((($old_price - $price) / $old_price) * 100);
        }
        return 0;
    }
}
