<?php

namespace App\Providers;

use App\Settings\SettingService;
use Illuminate\Support\ServiceProvider;

class CustomFacadeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 将settings服务注册到容器中，名字为setting
        $this->app->singleton('setting', function () {
            return $this->app->make(SettingService::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
