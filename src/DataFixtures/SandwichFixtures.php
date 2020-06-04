<?php

namespace App\DataFixtures;

use App\Entity\Plate;
use App\Entity\Sandwich;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SandwichFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->loadSandwich($manager);
        $manager->flush();
    }

    private function loadSandwich(ObjectManager $manager) {
        $category = $this->getReference('sandwich');
        $sandwichData = [
            [
                'label' => "Le Kebab",
                'support' => "avec frites",
                'formula' => "Formule Kebab*"
            ],
            [
                'label' => "Miche Kebab",
                'support' => "avec frites",
                'formula' => "Formule Miche Kebab*"
            ],
            [
                'label' => "La Galette Kebab",
                'support' => "avec frites",
                'formula' => "Formule Galette Kebab*"
            ]
        ];

        foreach ($sandwichData as $key => $value) {
            $sandwich = new Plate();
            $sandwich->setLabel($value['label']);
            $sandwich->setSupport($value['support']);
            $sandwich->setFormula($value['formula']);
            $category->addPlate($sandwich);
            $manager->persist($sandwich);
        }
    }

    public function getDependencies()
    {
        return [
            ProductCategoryFixtures::class
        ];
    }
}
