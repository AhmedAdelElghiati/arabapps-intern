<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function switch(string $locale)
    {
        $supportedLocales = ['ar', 'en'];

        if (in_array($locale, $supportedLocales, true)) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
