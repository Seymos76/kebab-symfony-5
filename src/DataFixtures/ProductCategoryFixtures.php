<?php
namespace App\DataFixtures;

use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $homeMade = ProductCategory::create('home made');
        $manager->persist($homeMade);

        $sandwich = ProductCategory::create('Sandwich');
        $manager->persist($sandwich);

        $fries = ProductCategory::create('Frites');
        $manager->persist($fries);

        $entries = ProductCategory::create('Entrées');
        $manager->persist($entries);

        $salads = ProductCategory::create('Salades');
        $manager->persist($salads);

        $plats = ProductCategory::create('Plats');
        $manager->persist($plats);

        $desserts = ProductCategory::create('Desserts');
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
