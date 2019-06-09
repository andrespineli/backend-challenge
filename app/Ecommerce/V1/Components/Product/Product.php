<?php

namespace App\Ecommerce\V1\Components\Product;

use App\Ecommerce\V1\Components\Product\ProductComponent;
use App\Ecommerce\V1\Components\Product\ProductRepository;

class Product implements ProductComponent
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function newProduct(array $product): array
    {
        return $this->repository->create($product);
    }

    public function getProducts(): array
    {
        return $this->repository->all();
    }

    public function getProductBySku(int $sku): array
    {
        return $this->repository->getProductBySku($sku);
    }
}
