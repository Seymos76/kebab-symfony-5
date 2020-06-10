<?php

namespace App\DataFixtures;

use App\Entity\Plate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class DessertsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->loadDesserts($manager);
        $manager->flush();
    }

    private function loadDesserts(ObjectManager $manager)
    {
        $dessertsData = [
            [
                'label' => "Patisserie Turque",
                'price' => 3
            ],
            [
                'label' => "Lokoum",
                'price' => 3
            ],
            [
                'label' => "Gâteau Almondy",
                'price' => 3
            ],
        ];
        $category = $this->getReference('desserts');

        foreach ($dessertsData as $key => $value) {
            $dessert = new Plate();
            $dessert->setLabel($value['label']);
            $dessert->setSlug($value['label']);
            $dessert->setPrice($value['price']);
            $category->addPlate($dessert);
            //$dessert->setProductCategory($category);
            $manager->persist($dessert);
        }
    }

    public function getDependencies()
    {
        return [
            ProductCategoryFixtures::class
        ];
    }
}
