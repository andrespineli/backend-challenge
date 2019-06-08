<?php

namespace App\Ecommerce\V1\Components\OrderItem;

use App\Ecommerce\V1\Components\OrderItem\OrderItemComponent;
use App\Ecommerce\V1\Components\OrderItem\OrderItemRepository;

class OrderItem implements OrderItemComponent
{
    private $repository;

    public function __construct(OrderItemRepository $repository) {
        $this->repository = $repository;       
    }  

    public function addItemsInOrder(array $orderItems) : bool
    {      
        return $this->repository->createItems($orderItems);
    }
}
