<?php

namespace App\DataFixtures;

use App\Entity\Plate;
use App\Uploader\ImageUploader;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PlatesFixtures extends Fixture implements DependentFixtureInterface
{
    private static $plateImages = [
        '001-hamburger.png',
        '002-pancakes.png',
        '003-chicken-bucket.png',
        '004-burger.png',
        '005-kebab.png',
        '006-waiter.png',
    ];

    private $imageUploader;

    public function __construct(ImageUploader $imageUploader)
    {
        $this->imageUploader = $imageUploader;
    }

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
            $imageFilename = $this->imageUploader
                ->upload(new File(__DIR__.'/images/flaticons/'.self::$plateImages[$key]));
            $plate = new Plate();
            $plate->setImage($imageFilename);
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
