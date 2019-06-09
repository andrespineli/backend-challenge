<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\Customer;
use App\Ecommerce\V1\Infrastructure\Models\Product;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    public function testItCanCreateNewProduct()
    {
        $authCustomer = factory(Customer::class)->make();

        $product = factory(Product::class)->make()
            ->toArray();

        $this->actingAs($authCustomer)
            ->json('POST', '/api/v1/products', $product)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'sku',
                'name',
                'price',
                'created_at',
                'updated_at'
            ]);
    }

    public function testItCanGetAllProducts()
    {

        factory(Product::class, 5)->create()
            ->toArray();

        $this->json('GET', '/api/v1/products')
            ->assertStatus(200)
            ->assertJsonStructure([
                0 => [
                    'id',
                    'sku',
                    'name',
                    'price',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }
}
