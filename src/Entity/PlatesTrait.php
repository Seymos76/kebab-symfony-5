<?php


namespace App\Entity;


use Cocur\Slugify\Slugify;

trait PlatesTrait
{
    public function getStringSlug(?string $slug): string
    {
        $slugger = new Slugify();
        return $slugger->slugify($slug);
    }
}
