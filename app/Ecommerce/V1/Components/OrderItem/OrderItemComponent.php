<?php

namespace App\Ecommerce\V1\Components\OrderItem;

interface OrderItemComponent
{
    public function addItemsInOrder(array $orderItems): bool;
}
