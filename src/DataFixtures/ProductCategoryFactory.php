<?php
namespace App\DataFixtures;

use App\Entity\ProductCategory;
use Cocur\Slugify\Slugify;

class ProductCategoryFactory
{
    private $slugger;

    public function __construct()
    {
        $this->slugger = new Slugify();
    }

    public function createProductCategory(string $label): ProductCategory
    {
        $category = new ProductCategory();
        $category->setLabel($label);
        $category->setSlug($this->getStrSlug($label));
        return $category;
    }

    private function getStrSlug(string $string)
    {
        return $this->slugger->slugify($string);
    }
}
