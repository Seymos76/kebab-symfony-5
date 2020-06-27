<?php

namespace App\DataFixtures;

use App\Entity\Plate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PlatesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->loadPlates($manager);
        $manager->flush();
    }

    private function loadPlates(ObjectManager $manager)
    {
        $platesData = [
            [
                'label' => "Kebab",
                'price' => 11
            ],
            [
                'label' => "Brochette Poulet",
                'price' => 11
            ],
            [
                'label' => "Steak",
                'price' => 11
            ],
        ];

        foreach ($platesData as $key => $value) {
            $plate = new Plate();
            $plate->setLabel($value['label']);
            $plate->setPrice($value['price']);
            $manager->persist($plate);
        }
    }

    public function getDependencies()
    {
        return [
            ProductCategoryFixtures::class
        ];
    }
}
