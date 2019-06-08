<?php

namespace App\Ecommerce\V1\Components\Product;

interface ProductComponent
{
    public function newProduct(array $product) : array;
    public function getProducts() : array;
    public function getProductBySku(int $sku) : array;
}