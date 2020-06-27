<?php

namespace App\DataFixtures;

use App\Entity\Salad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SaladsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->loadSalads($manager);
        $manager->flush();
    }

    private function loadSalads(ObjectManager $manager)
    {
        $saladData = [
            [
                'label' => "Thon",
                'price' => 7.5
            ],
            [
                'label' => "Méditerranéenne",
                'price' => 7.5
            ],
            [
                'label' => "Saumon",
                'price' => 7.5
            ],
        ];

        foreach ($saladData as $key => $value) {
            $salad = Salad::create();
            $salad->setLabel($value['label']);
            $salad->setPrice($value['price']);
            $manager->persist($salad);
        }
    }

    public function getDependencies()
    {
        return [
            ProductCategoryFixtures::class
        ];
    }
}
