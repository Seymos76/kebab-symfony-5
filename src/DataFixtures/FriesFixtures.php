<?php

namespace App\DataFixtures;

use App\Entity\Plate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FriesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->loadFries($manager);
        $manager->flush();
    }

    private function loadFries(ObjectManager $manager)
    {
        $category = $this->getReference('fries');
        $friesData = [
            [
                'label' => "Petite frite",
                'price' => 2.5
            ],
            [
                'label' => "Moyenne frite",
                'price' => 3.5
            ],
            [
                'label' => "Grande frite",
                'price' => 4.5
            ],
        ];

        foreach ($friesData as $key => $value) {
            $fries = new Plate();
            $fries->setLabel($value['label']);
            $fries->setPrice($value['price']);
            $category->addPlate($fries);
            $manager->persist($fries);
        }
    }

    public function getDependencies()
    {
        return [
            ProductCategoryFixtures::class
        ];
    }
}
