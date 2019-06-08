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
            'App\Ecommerce\V1\Components\Auth\AuthRepository',
            'App\Ecommerce\V1\Components\Auth\LaravelAuthRepository'
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

        $this->app->bind(
            'App\Ecommerce\V1\Components\Order\OrderRepository',
            'App\Ecommerce\V1\Components\Order\EloquentOrderRepository'
        );

        $this->app->bind(
            'App\Ecommerce\V1\Components\Order\OrderComponent',
            'App\Ecommerce\V1\Components\Order\Order'
        );

        $this->app->bind(
            'App\Ecommerce\V1\Components\OrderItem\OrderItemRepository',
            'App\Ecommerce\V1\Components\OrderItem\EloquentOrderItemRepository'
        );

        $this->app->bind(
            'App\Ecommerce\V1\Components\OrderItem\OrderItemComponent',
            'App\Ecommerce\V1\Components\OrderItem\OrderItem'
        );
    }
}
