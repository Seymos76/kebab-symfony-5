<?php
namespace App\DataFixtures;

use App\Entity\ProductCategory;
use Cocur\Slugify\Slugify;

class ProductCategoryFactory
{
    public static function createProductCategory(string $label): ProductCategory
    {
        $category = new ProductCategory();
        $category->setLabel($label);
        $slugger = new Slugify();
        $slugged = $slugger->slugify($label);
        $category->setSlug($slugged);
        return $category;
    }
}
