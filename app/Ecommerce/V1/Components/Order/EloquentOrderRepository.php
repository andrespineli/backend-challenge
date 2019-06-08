<?php

namespace App\Ecommerce\V1\Components\Order;

use App\Ecommerce\V1\Infrastructure\Repositories\EloquentRepository;
use App\Ecommerce\V1\Components\Order\OrderRepository;
use App\Ecommerce\V1\Infrastructure\Models\Order;

class EloquentOrderRepository extends EloquentRepository implements OrderRepository
{
    protected $entity;

    public function __construct(Order $entity)
    {
        $this->entity = $entity;
    }  

    public function getOrderWithItems(int $orderId) : array
    {
        return $this->entity
                    ->where('id', $orderId)
                    ->with('buyer', 'items', 'items.product')
                    ->first()
                    ->toArray();
    }

    public function getAllOrders() : array
    {
        return $this->entity
                    ->with('buyer', 'items', 'items.product')
                    ->get()
                    ->toArray();
    }
}