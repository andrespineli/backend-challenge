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

    public function setUp()
    {
        parent::setUp();
        $this->entity = Order::class;
        $this->orderComponent = $this->app->make('App\Ecommerce\V1\Components\Order\OrderComponent');
    }

    public function testItCanCreateNewOrder()
    {
        $customer = factory(Customer::class)->create();
        $this->be($customer);

        $products = factory(Product::class, 5)->create()
            ->toArray();

        foreach ($products as $product) {
            $item['sku'] = $product['sku'];
            $item['amount'] = rand(1, 5);
            $items['items'][] = $item;
        }

        $order = $this->orderComponent->newOrder($items);
        $this->assertNotEmpty($order);
        $this->assertArrayHasKey('id', $order);
    }

    public function testItCanGetAllOrders()
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

    public function testItCanGetAorder()
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

    public function testItCanCancelAorder()
    {
        $order = factory($this->entity)->create();
        $canceled = $this->orderComponent->cancelOrder($order['id']);
        $this->assertEquals($canceled['status'], 'CANCELED');
    }

    public function testItCanGetItemsFromOrder()
    {
        $products = factory(Product::class, 5)->create()
            ->toArray();
        $orderId = factory(Order::class)->create()->toArray()['id'];

        foreach ($products as $product) {
            $item['sku'] = $product['sku'];
            $item['amount'] = rand(1, 5);
            $items[] = $item;
        }

        $items = $this->invokePrivateMethod($this->orderComponent, 'getItemsFromOrder', [
            'requestItems' => $items,
            'orderId' => $orderId
        ]);

        foreach ($items as $item) {
            $this->assertArrayHasKey('order_id', $item);
            $this->assertArrayHasKey('amount', $item);
            $this->assertArrayHasKey('product_id', $item);
            $this->assertArrayHasKey('price_unit', $item);
            $this->assertArrayHasKey('total', $item);
            $total = $item['amount'] * $item['price_unit'];
            $this->assertEquals($total, $item['total']);
        }
    }

    public function testItCanGetOrderTotalPriceOfItems()
    {
        $orderItems = factory(OrderItem::class, 5)->make()
            ->toArray();

        $total = array_sum(array_map(function ($value) {
            return $value['total'];
        }, $orderItems));

        $price = $this->invokePrivateMethod($this->orderComponent, 'getOrderTotalPriceOfItems', [
            'items' => $orderItems
        ]);

        $this->assertEquals($total, $price);
    }
}
