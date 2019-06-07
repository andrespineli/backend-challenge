<?php

namespace App\Ecommerce\V1\Components\Product;

use App\Ecommerce\V1\Infrastructure\Repositories\EloquentRepository;
use App\Ecommerce\V1\Components\Product\ProductRepository;
use App\Ecommerce\V1\Infrastructure\Models\Product;

class EloquentProductRepository extends EloquentRepository implements ProductRepository
{
    protected $entity;

    public function __construct(Product $entity)
    {
        $this->entity = $entity;
    }  
}