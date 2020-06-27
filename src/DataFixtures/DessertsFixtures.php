<?php

namespace App\DataFixtures;

use App\Entity\Dessert;
use App\Entity\AbstractPlate;
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

        foreach ($dessertsData as $key => $value) {
            $dessert = new Dessert($value['label']);
            $dessert->setPrice($value['price']);
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
