<?php


namespace App\Interfaces;


interface ProductInterface
{
    public function isAvailable(): bool;

    public function typeOf(): string;
}
