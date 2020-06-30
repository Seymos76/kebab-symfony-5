<?php
namespace App\Ecommerce\Ordering;

use App\Entity\CartItem;

interface OrderingInterface
{
    public function addProduct(CartItem $plate): self;

    public function removeProduct(CartItem $plate): self;

    public function emptyCart(): void;

    public function countProducts(): int;
}
