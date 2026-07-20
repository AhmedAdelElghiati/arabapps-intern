<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'TMS'],
            ['key' => 'site_email', 'value' => 'info@tms.com'],
            ['key' => 'site_phone', 'value' => '+1234567890'],
            ['key' => 'site_address', 'value' => '123 Main Street'],
            ['key' => 'facebook_url', 'value' => null],
            ['key' => 'instagram_url', 'value' => null],
            ['key' => 'youtube_url', 'value' => null],
            ['key' => 'twitter_url', 'value' => null],
            ['key' => 'about_us', 'value' => 'Welcome to TMS, your trusted learning platform.'],
            ['key' => 'terms_and_conditions', 'value' => null],
            ['key' => 'privacy_policy', 'value' => null],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
