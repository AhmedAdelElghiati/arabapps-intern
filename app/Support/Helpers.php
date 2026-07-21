<?php

use App\Models\Setting;

if (! function_exists('uploadsPath')) {
    /**
     * @return mixed|string|null
     */
    function uploadsPath($postfix = null)
    {
        if ($postfix == null) {
            return null;
        }

        if (filter_var($postfix, FILTER_VALIDATE_URL)) {
            return $postfix;
        }

        return asset('storage/'.$postfix);
    }
}

if (! function_exists('convertArabicNumerals')) {
    function convertArabicNumerals($number)
    {
        $arabicNumerals = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $westernNumerals = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($arabicNumerals, $westernNumerals, $number);
    }
}

if (! function_exists('startOfWeek')) {
    function startOfWeek()
    {
        return now()->startOfWeek();
    }
}

if (! function_exists('endOfWeek')) {
    function endOfWeek()
    {
        return now()->endOfWeek();
    }
}

if (! function_exists('settings')) {
    function settings($key = null)
    {
        $settings = Setting::first();
        //        $settings = [
        //            'app_active' => true,
        //            'force_update_android_version' => false,
        //            'force_update_ios_version' => false,
        //            'android_version' => "1.0.0",
        //            'ios_version' => "1.0.0",
        //            'firebase_secret_token' => null,
        //        ];

        return $key ? $settings[$key] : $settings;
    }
}

/**
 * Get the authenticated user for the given guard.
 *
 * @param  string  $guard  The authentication guard name (e.g., 'admin', 'user', 'collector')
 * @return \Illuminate\Contracts\Auth\Authenticatable|null
 */
if (! function_exists('authUser')) {
    function authUser(string $guard)
    {
        return auth()->guard($guard)->user();
    }
}

if (! function_exists('lang')) {
    function lang(): string
    {
        return app()->getLocale();
    }
}
