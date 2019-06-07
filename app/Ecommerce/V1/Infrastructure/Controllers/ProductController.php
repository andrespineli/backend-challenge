<?php

namespace App\Ecommerce\V1\Infrastructure\Controllers;

use App\Ecommerce\V1\Infrastructure\Controllers\Controller;
use App\Ecommerce\V1\Infrastructure\Requests\ProductNew;
use App\Ecommerce\V1\Components\Product\ProductComponent;

class ProductController extends Controller
{
    private $product; 

    public function __construct(ProductComponent $product) 
    {
        $this->product = $product;
    }

    public function new(ProductNew $product)
    {
        $product = $product->validated();
        return $this->product->newProduct($product);       
    } 

    public function get()
    {
        return $this->product->getProducts();
    }  
}
