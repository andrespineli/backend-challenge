<?php

use Illuminate\Database\Seeder;
use App\Ecommerce\V1\Infrastructure\Models\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Customer::class, 5)->create();
    }
}
