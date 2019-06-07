<?php

namespace App\Ecommerce\V1\Components\Product;

interface ProductComponent
{
    public function newProduct($request);  
    public function getProducts();
 
}