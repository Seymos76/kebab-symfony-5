<?php

namespace App\DataFixtures;

use App\Entity\Plate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EntriesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->loadEntries($manager);
        $manager->flush();
    }

    private function loadEntries(ObjectManager $manager)
    {
        $category = $this->getReference('entries');
        $entryData = [
            [
                'label' => "Cacik",
                'price' => 7.5
            ],
            [
                'label' => "Feuilles de Vigne",
                'price' => 7.5
            ],
            [
                'label' => "Sigara Börek",
                'price' => 7.5
            ],
        ];
        //$category = $this->getReference('entries');

        foreach ($entryData as $key => $value) {
            $entry = new Plate();
            $entry->setLabel($value['label']);
            $entry->setSlug($value['label']);
            $entry->setPrice($value['price']);
            $category->addPlate($entry);
            $manager->persist($entry);
        }
    }

    public function getDependencies()
    {
        return [
            ProductCategoryFixtures::class
        ];
    }
}
