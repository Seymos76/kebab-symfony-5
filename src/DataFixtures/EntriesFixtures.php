<?php

namespace App\DataFixtures;

use App\Entity\Entry;
use App\Entity\AbstractPlate;
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

        foreach ($entryData as $key => $value) {
            $entry = new Entry();
            $entry->setLabel($value['label']);
            $entry->setPrice($value['price']);
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
