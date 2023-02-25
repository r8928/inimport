<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::directive('config', function (string $expression) {
            return "<?php echo \App\Models\Config::value({$expression}) ?? \"\"; ?>";
        });
    }
}
