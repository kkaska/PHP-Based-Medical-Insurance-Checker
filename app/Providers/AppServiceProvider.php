<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('parseMoney', function ($money) {
            return "$<?php echo number_format($money, 2); ?>";
        });

        Blade::directive('parseDistance', function ($distance) {
            return "<?php if($distance < 1) {
                        echo 'Less than a mile';
                    } else if ($distance >= 1 && $distance < 5) {
                        echo 'Less than 5 miles';
                    } else {
                        echo number_format((float)$distance, 1) . ' mi';
                    } ?>";
        });
    }
}
