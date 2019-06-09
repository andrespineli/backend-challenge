<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\Order;
use App\Ecommerce\V1\Infrastructure\Models\Customer;
use App\Ecommerce\V1\Infrastructure\Models\Product;
use App\Ecommerce\V1\Infrastructure\Models\OrderItem;

class OrderTest extends TestCase
{
    use DatabaseMigrations;

    private $entity;
    private $orderComponent; 
    
    public function setUp() {
        parent::setUp();
        $this->entity = Order::class;  
        $this->orderComponent = $this->app->make('App\Ecommerce\V1\Components\Order\OrderComponent');
    }

    public function test_it_can_create_new_order()
    {
        $customer = factory(Customer::class)->create();
        $this->be($customer);

        $products = factory(Product::class, 5)->create()
                                              ->toArray();

        foreach($products as $product) {
            $item['sku'] = $product['sku'];
            $item['amount'] = rand(1, 5);
            $items['items'][] = $item;
        }

        $order = $this->orderComponent->newOrder($items);   
        $this->assertNotEmpty($order);  
        $this->assertArrayHasKey('id', $order);  
    }

    public function test_it_can_get_all_orders()
    {
        factory($this->entity)->create();         
        $orderItem = factory(OrderItem::class)->create();         
        $order = Order::find($orderItem->order_id)
                        ->with('buyer', 'items', 'items.product')
                        ->get()                        
                        ->toArray();  
                    
        $orders = $this->orderComponent->getOrders();           
        $this->assertEquals($order, $orders);             
    }

    public function test_it_can_get_get_a_order()
    {
        factory($this->entity)->create();         
        $orderItem = factory(OrderItem::class)->create();         
        $order = Order::find($orderItem->order_id)
                        ->with('buyer', 'items', 'items.product')
                        ->first()                        
                        ->toArray();  

        $get = $this->orderComponent->getOrder($order['id']);                   
        $this->assertEquals($order, $get);    
    }

    public function test_it_can_cancel_a_order()
    {
        $order = factory($this->entity)->create();         
        $canceled = $this->orderComponent->cancelOrder($order['id']);      
        $this->assertEquals($canceled['status'], 'CANCELED');    
    }
}