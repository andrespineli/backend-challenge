<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Ecommerce\V1\Infrastructure\Models\Product;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    private $entity;
    private $productComponent;

    public function setUp()
    {
        parent::setUp();
        $this->entity = Product::class;
        $this->productComponent = $this->app->make('App\Ecommerce\V1\Components\Product\ProductComponent');
    }

    public function testItCanCreateNewProduct()
    {
        $mock = factory($this->entity)->make()
            ->toArray();

        $product = $this->productComponent->newProduct($mock);
        $this->assertArraySubset($mock, $product);
    }

    public function testItCanGetAllProducts()
    {
        $mock = factory($this->entity, 5)->create()
            ->toArray();

        $products = $this->productComponent->getProducts();
        $this->assertArraySubset($mock, $products);
    }

    public function testItCanGetProductBySku()
    {
        $mock = factory($this->entity)->create()
            ->toArray();

        $product = $this->productComponent->getProductBySku($mock['sku']);
        $this->assertArraySubset($mock, $product);
    }
}
