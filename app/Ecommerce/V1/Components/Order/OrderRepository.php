<?php

namespace App\Ecommerce\V1\Components\Order;

interface OrderRepository
{
    public function getOrderWithItems(int $orderId): array;
    public function getAllOrders(): array;
}
