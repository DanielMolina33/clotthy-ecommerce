<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Product;
use App\View\Components\Navbar;

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
        Blade::component('product', Product::class);
        Blade::component('navbar', Navbar::class);
        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 0); ?>";
        });
    }
}
