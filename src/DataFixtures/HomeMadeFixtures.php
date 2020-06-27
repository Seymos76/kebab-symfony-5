<?php

namespace App\DataFixtures;

use App\Entity\HomeMade;
use App\Entity\AbstractPlate;
use App\Entity\ProductCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class HomeMadeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadHomeMade($manager);
        $manager->flush();
    }

    private function loadHomeMade(ObjectManager $manager) {
        $homeMadeData = [
            "Le KeBab",
            "L'assiette Baba",
            "Le Tacos",
        ];

        foreach ($homeMadeData as $key => $value) {
            $home_made = new HomeMade();
            $home_made->setLabel($value);
            $manager->persist($home_made);
        }
    }
}
