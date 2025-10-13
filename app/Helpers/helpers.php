<?php

use App\Models\Setting;

if (!function_exists('currency')) {
    function currency()
    {
        $setting = Setting::first();

        // currency যদি থাকে → brackets এ wrap করে দেখাবে, না হলে কিছু দেখাবে না
        return $setting && !empty($setting->currency) ? $setting->currency : '';
    }
}