<?php


namespace xGrz\LarSet\Observers;

use xGrz\LarSet\Services\AppSettingsService;

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
