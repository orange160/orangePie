<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use function foo\func;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Custom blade view directive  定义了自定义指令后，要清除视图缓存 php artisan view:clear
        Blade::directive('icon', function ($expression){
            return "<?php echo icon($expression); ?>";
        });
    }
}
