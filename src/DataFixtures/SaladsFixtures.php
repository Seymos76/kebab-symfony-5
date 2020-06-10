<?php

namespace App\DataFixtures;

use App\Entity\Plate;
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
        $category = $this->getReference('salads');

        foreach ($saladData as $key => $value) {
            $salad = new Plate();
            $salad->setLabel($value['label']);
            $salad->setSlug($value['label']);
            $salad->setPrice($value['price']);
            $category->addPlate($salad);
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
