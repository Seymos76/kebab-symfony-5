<?php
namespace App\Interfaces;

interface SluggableInterface {
    public function getSlug(): ?string;

    public function setSlug(string $sluggableString): string;
}