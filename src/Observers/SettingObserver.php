<?php


namespace xGrz\LaraSet\Observers;

use xGrz\LaraSet\Services\AppSettingsService;

class SettingObserver
{
    public function created(): void
    {

        cache()->forget(AppSettingsService::APP_SETTINGS_CACHE_KEY);
    }

    public function updated(): void
    {
        cache()->forget(AppSettingsService::APP_SETTINGS_CACHE_KEY);
    }
}
