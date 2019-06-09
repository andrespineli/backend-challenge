<?php

namespace App\Ecommerce\V1\Components\Order;

interface OrderComponent
{
    public function newOrder(array $order): array;
    public function getOrders(): array;
    public function getOrder(int $id): array;
    public function cancelOrder(int $id): array;
}
