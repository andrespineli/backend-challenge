<?php

namespace App\Ecommerce\V1\Components\Product;

use App\Ecommerce\V1\Components\Product\ProductComponent;
use App\Ecommerce\V1\Components\Product\ProductRepository;

class Product implements ProductComponent
{
    private $repository;

    public function __construct(ProductRepository $repository) {
        $this->repository = $repository;
    }

    public function newProduct($customer)
    {
        return $this->repository->create($customer);
    }

    public function getProducts()
    {
        return $this->repository->all();
    }

}
