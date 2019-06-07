<?php

namespace App\Ecommerce\V1\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Ecommerce\V1\Components\Customer\CustomerRepository',
            'App\Ecommerce\V1\Components\Customer\EloquentCustomerRepository'
        );

        $this->app->bind(
            'App\Ecommerce\V1\Components\Customer\CustomerComponent',
            'App\Ecommerce\V1\Components\Customer\Customer'
        );

        $this->app->bind(
            'App\Ecommerce\V1\Components\Auth\AuthComponent',
            'App\Ecommerce\V1\Components\Auth\Auth'
        );

        $this->app->bind(
            'App\Ecommerce\V1\Components\Product\ProductRepository',
            'App\Ecommerce\V1\Components\Product\EloquentProductRepository'
        );

        $this->app->bind(
            'App\Ecommerce\V1\Components\Product\ProductComponent',
            'App\Ecommerce\V1\Components\Product\Product'
        );
    }
}
