<?php

namespace App\Ecommerce\V1\Components\Product;

interface ProductRepository
{
    public function getProductBySku(int $sku) : array;
}