<?php

namespace App\Ecommerce\V1\Components\OrderItem;

interface OrderItemRepository
{
    public function createItems(array $items) : bool;
}