<?php

use Carbon\Carbon;

if (!function_exists('format_date')) {
    /**
     * Format a date to the desired format.
     *
     * @param string|\DateTime|null $date The date to format.
     * @param string $format The desired date format.
     * @return string|null
     */
    function format_date($date, $format = 'd M Y h:i A')
    {
        if (empty($date)) {
            return '-';
        }

        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('getImageUrl')) {

    /**
     * Get the image URL for a given image path.
     *
     * @param string $path The path to the image.
     * @return string The URL to the image.
     */
    function getImageUrl($image, $path)
    {
        // Define the full path to check
        $imagePath = public_path($path . '/' . $image);

        if (file_exists($imagePath) && !empty($image)) {
            return asset($path . '/' . $image);
        }

        return asset('uploads/image/default.png');
    }

}

if (!function_exists('format_time')) {

    /**
     * Format a time to the desired format.
     *
     * @param string $time The time to format.
     * @param string $format The desired time format.
     * @return string
     */
    function format_time($time,$offsetHours = 0 ,$format = 'h:i A')
    {
        if(empty($time)) {
            return '-';
        }
        return Carbon::createFromFormat('H:i:s', $time)
            ->addHours($offsetHours)
            ->format($format);
    }
}
if (!function_exists('format_currency')) {

    /**
     * Format a currency to the desired format.
     *
     * @param string $amount The amount to format.
     * @return string
     */
    function format_currency($number, $currency = '$', $decimal = 2, $thousands_separator = ',') {
        return $currency . ' ' . number_format($number, $decimal, '.', $thousands_separator);
    }
}

if (!function_exists('format_number')) {

    /**
     * Format a number to the desired format.
     *
     * @param string $amount The amount to format.
     * @return string
     */
    function format_number($number, $decimal = 2, $thousands_separator = ',') {
        return number_format($number, $decimal, '.', $thousands_separator);
    }
}
if (!function_exists('format_percentage')) {

    /**
     * Format a percentage to the desired format.
     *
     * @param string $amount The amount to format.
     * @return string
     */
    function format_percentage($number, $decimal = 2, $thousands_separator = ',') {
        return number_format($number, $decimal, '.', $thousands_separator) . ' %';
    }
}

if (!function_exists('format_date_time')) {

    /**
     * Format a date to the desired format.
     *
     * @param string|\DateTime|null $date The date to format.
     * @param string $format The desired date format.
     * @return string|null
     */
    function format_date_time($date, $format = 'd M Y h:i A')
    {
        if (empty($date)) {
            return '-';
        }

        return Carbon::parse($date)->format($format);
    }
}
