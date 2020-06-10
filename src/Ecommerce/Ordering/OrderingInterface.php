<?php
namespace App\Ecommerce\Ordering;

interface OrderingInterface {
    public function addProduct(array $product);
    public function removeProduct(array $product);
    public function setProductQuantity(int $product, int $qty);
    public function emptyCart();
}