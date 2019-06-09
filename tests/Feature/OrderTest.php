<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\Customer;
use App\Ecommerce\V1\Infrastructure\Models\Product;
use App\Ecommerce\V1\Infrastructure\Models\Order;
use App\Ecommerce\V1\Infrastructure\Models\OrderItem;

class OrderTest extends TestCase
{
    use DatabaseMigrations;

    public function testItCanCreateNewOrder()
    {
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 5)->create()
            ->toArray();

        foreach ($products as $product) {
            $item['sku'] = $product['sku'];
            $item['amount'] = rand(1, 5);
            $items['items'][] = $item;
        }

        $this->actingAs($customer)
            ->json('POST', '/api/v1/orders', $items)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'total',
                'status',
                'created_at',
                'updated_at',
                'buyer' => [
                    'id',
                    'name',
                    'cpf',
                    'email'
                ],
                'items' => [
                    0 => [
                        'amount',
                        'price_unit',
                        'total',
                        'product' => [
                            'id',
                            'sku',
                            'name',
                            'price',
                            'created_at',
                            'updated_at'
                        ]
                    ]
                ]
            ]);
    }

    public function testItCanGetAllOrders()
    {
        $authCustomer = factory(Customer::class)->make();
        factory(OrderItem::class)->create();

        $this->actingAs($authCustomer)
            ->json('GET', '/api/v1/orders')
            ->assertStatus(200)
            ->assertJsonStructure([
                0 => [
                    'id',
                    'total',
                    'status',
                    'created_at',
                    'updated_at',
                    'buyer' => [
                        'id',
                        'name',
                        'cpf',
                        'email'
                    ],
                    'items' => [
                        0 => [
                            'amount',
                            'price_unit',
                            'total',
                            'product' => [
                                'id',
                                'sku',
                                'name',
                                'price',
                                'created_at',
                                'updated_at'
                            ]
                        ]
                    ]
                ]
            ]);
    }

    public function testItCanCancelAorder()
    {
        $authCustomer = factory(Customer::class)->make();
        $orderId = factory(Order::class)->create()->toArray()['id'];
        
        $this->actingAs($authCustomer)
            ->json('PUT', "/api/v1/orders/{$orderId}")
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'total',
                'status',
                'created_at',
                'updated_at',
            ]);
    }
}
