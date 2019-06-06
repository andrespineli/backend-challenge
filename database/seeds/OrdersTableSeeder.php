<?php

use Illuminate\Database\Seeder;
use App\Ecommerce\V1\Infrastructure\Models\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 5)->create();
    }
}
