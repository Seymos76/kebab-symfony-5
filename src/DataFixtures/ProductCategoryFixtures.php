<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\ProductCategoryFactory;
use Doctrine\Common\Persistence\ObjectManager;

class ProductCategoryFixtures extends Fixture
{
    private $productCategoryFactory;

    public function __construct(ProductCategoryFactory $productCategoryFactory)
    {
        $this->productCategoryFactory = $productCategoryFactory;
    }
    public function load(ObjectManager $manager)
    {
        $homeMade = $this->productCategoryFactory->createProductCategory('home made');
        $manager->persist($homeMade);

        $sandwich = $this->productCategoryFactory->createProductCategory('Sandwich');
        $manager->persist($sandwich);

        $fries = $this->productCategoryFactory->createProductCategory('Frites');
        $manager->persist($fries);

        $entries = $this->productCategoryFactory->createProductCategory('Entrées');
        $manager->persist($entries);

        $salads = $this->productCategoryFactory->createProductCategory('Salades');
        $manager->persist($salads);

        $plats = $this->productCategoryFactory->createProductCategory('Plats');
        $manager->persist($plats);

        $desserts = $this->productCategoryFactory->createProductCategory('Desserts');
        $manager->persist($desserts);
        
        $manager->flush();

        $this->addReference('home_made', $homeMade);
        $this->addReference('sandwich', $sandwich);
        $this->addReference('fries', $fries);
        $this->addReference('entries', $entries);
        $this->addReference('salads', $salads);
        $this->addReference('plats', $plats);
        $this->addReference('desserts', $desserts);
    }
}
