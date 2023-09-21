<?php

namespace xGrz\LarSet;

use Illuminate\Support\ServiceProvider;

class LarSetServiceProvider extends ServiceProvider
{
   public function register(): void
    {
    }

    public function boot(): void
    {
//        $this->publishes([__DIR__ . '/../config/config.php' => config_path('laragus.php')]);
//
//        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

}
