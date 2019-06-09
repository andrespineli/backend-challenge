<?php

namespace App\Ecommerce\V1\Components\OrderItem;

use App\Ecommerce\V1\Infrastructure\Repositories\EloquentRepository;
use App\Ecommerce\V1\Components\OrderItem\OrderItemRepository;
use App\Ecommerce\V1\Infrastructure\Models\OrderItem;

class EloquentOrderItemRepository extends EloquentRepository implements OrderItemRepository
{
    protected $entity;

    public function __construct(OrderItem $entity)
    {
        $this->entity = $entity;
    }

    public function createItems(array $items): bool
    {
        return $this->entity->insert($items);
    }
}
