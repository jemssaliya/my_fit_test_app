<?php

namespace App\Providers;

use App\Entities\TestType;
use Blade;
use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws Exception
     */
    public function boot()
    {
        //To support unique collumns
        Schema::defaultStringLength(191);

        // Share test types across the app
        if (Schema::hasTable('test_types')) {
            View::share('testTypes', TestType::all());
        }

        // Blade functions
        Blade::component('components.alert', 'alert');

        // SStripe
        // Cashier::useCurrency('aud', '$');

        $this->loadViewsFrom(base_path('packages/emedia/oxygen/resources/views'), 'oxygen');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
