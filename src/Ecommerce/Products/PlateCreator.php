<?php


namespace App\Ecommerce\Products;


use App\Entity\Plate;
use App\Entity\Sandwich;
use App\Interfaces\ProductInterface;

class PlateCreator extends ProductFactory
{
    public function createProduct(array $plate): ProductInterface
    {
        $plate = (new Sandwich())
        ->setLabel($plate['label'])->setPrice($plate['price']);
        return $plate;
    }

}
