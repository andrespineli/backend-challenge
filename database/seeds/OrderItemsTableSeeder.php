<?php

use Illuminate\Database\Seeder;
use App\Ecommerce\V1\Infrastructure\Models\OrderItem;

class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderItem::class, 5)->create();
    }
}
