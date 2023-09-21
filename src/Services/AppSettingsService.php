<?php

namespace xGrz\LarSet\Services;


use xGrz\LarSet\Exceptions\AppSettingsNotFoundException;
use xGrz\LarSet\Models\Setting;

class AppSettingsService
{

    const APP_SETTINGS_CACHE_KEY = 'appSettings';

    /**
     * @throws AppSettingsNotFoundException
     */
    public static function read(string $key)
    {
        $key = strtolower($key);
        $settings = self::all();
        if (!isset($settings[$key])) {
            throw new AppSettingsNotFoundException("Key `" . $key . "` not found in AppSettings", 1);
        }
        return $settings[$key];
    }

    public static function all(): string|int|array
    {
        cache()->remember(self::APP_SETTINGS_CACHE_KEY, 60 * 60 * 24, function () {
            return Setting::all(['key', 'value', 'type'])->toArray();
        });
        $settings = [];
        foreach (cache()->get(self::APP_SETTINGS_CACHE_KEY) as $setting) {
            $settings[$setting['key']] = $setting['value'];
        }
        return $settings;
    }

}
