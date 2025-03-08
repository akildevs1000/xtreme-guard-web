<?php

namespace App\Settings;

use App\Models\Setting\Setting;

class AppSettings
{
    public static function get($key, $userId = null, $default = null)
    {
        if ($userId) {
            return Setting::where('key', $key)->where('user_id', $userId)->value('value') ??
                Setting::where('key', $key)->where('level', 'app')->value('value') ??
                $default;
        }

        return Setting::where('key', $key)->where('level', 'app')->value('value') ?? $default;
    }

    public static function set($key, $value, $userId = null)
    {
        if ($userId) {
            Setting::updateOrCreate(
                ['key' => $key, 'user_id' => $userId, 'level' => 'user'],
                ['value' => $value]
            );
        } else {
            Setting::updateOrCreate(
                ['key' => $key, 'level' => 'app'],
                ['value' => $value]
            );
        }
    }
}
