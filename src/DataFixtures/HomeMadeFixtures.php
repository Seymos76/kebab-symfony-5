<?php

namespace App\DataFixtures;

use App\Entity\HomeMade;
use App\Entity\Plate;
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
        $category = $this->getReference('home_made');
        $homeMadeData = [
            "Le KeBab",
            "L'assiette Baba",
            "Le Tacos",
        ];

        foreach ($homeMadeData as $key => $value) {
            $home_made = new Plate();
            $home_made->setLabel($value);
            $category->addPlate($home_made);
            $manager->persist($home_made);
        }
    }
}
