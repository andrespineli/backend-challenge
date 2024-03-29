<?php

use Faker\Generator as Faker;
use App\Ecommerce\V1\Infrastructure\Models\OrderItem;
use App\Ecommerce\V1\Infrastructure\Models\Order;
use App\Ecommerce\V1\Infrastructure\Models\Product;

$factory->define(OrderItem::class, function (Faker $faker) {

    factory(Product::class, 5)->create();
    factory(Order::class)->create();

    $order = Order::inRandomOrder()->first();
    $amount = rand(1, 5);
    $product = Product::inRandomOrder()->first();
    $total = $product->price * $amount;
    $order->total = $order->total + $total;
    $order->save();

    return [
        'order_id' => $order->id,
        'product_id' => $product->id,
        'amount' => $amount,
        'price_unit' => $product->price,
        'total' => $total
    ];
});
