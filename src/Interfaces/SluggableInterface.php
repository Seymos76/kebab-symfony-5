<?php
namespace App\Interfaces;

interface SluggableInterface {
    public function getSlug(): ?string;

    public function getStringSlug(string $sluggableString): string;
}
