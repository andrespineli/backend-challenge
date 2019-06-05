<?php

use Faker\Generator as Faker;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

$factory->define(OrderItem::class, function (Faker $faker) {

    $order = Order::orderByRaw('RAND()')->first();
    $items = rand(1, 5);

    for ($i = 0; $i < $items; $i++) {

        $amount = rand(1, 5);
        $product = Product::orderByRaw('RAND()')->first();
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
    }
});
