<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProductCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $homeMade = ProductCategoryFactory::createProductCategory('home made');
        $manager->persist($homeMade);

        $sandwich = ProductCategoryFactory::createProductCategory('Sandwich');
        $manager->persist($sandwich);

        $fries = ProductCategoryFactory::createProductCategory('Frites');
        $manager->persist($fries);

        $entries = ProductCategoryFactory::createProductCategory('Entrées');
        $manager->persist($entries);

        $salads = ProductCategoryFactory::createProductCategory('Salades');
        $manager->persist($salads);

        $plats = ProductCategoryFactory::createProductCategory('Plats');
        $manager->persist($plats);

        $desserts = ProductCategoryFactory::createProductCategory('Desserts');
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
