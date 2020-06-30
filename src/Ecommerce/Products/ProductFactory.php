<?php


namespace App\Ecommerce\Products;


use App\Interfaces\ProductInterface;

abstract class ProductFactory
{
    abstract protected function createProduct(array $product): ProductInterface;
}
