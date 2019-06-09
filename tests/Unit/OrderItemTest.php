<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\OrderItem;

class OrderItemTest extends TestCase
{
    use DatabaseMigrations;

    private $entity;
    private $productComponent;

    public function setUp()
    {
        parent::setUp();
        $this->entity = OrderItem::class;
        $this->productComponent = $this->app->make('App\Ecommerce\V1\Components\OrderItem\OrderItemComponent');
    }

    public function testItAddItemsInOrder()
    {
        $orderItem = factory($this->entity)->create()
            ->makeVisible('product_id')
            ->makeVisible('order_id')
            ->toArray();

        $addItems = $this->productComponent->addItemsInOrder($orderItem);
        $this->assertTrue($addItems);
    }
}
