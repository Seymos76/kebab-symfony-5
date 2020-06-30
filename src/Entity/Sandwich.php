<?php

namespace App\Entity;

use App\Interfaces\ProductInterface;
use App\Repository\SandwichRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SandwichRepository::class)
 */
class Sandwich extends AbstractPlate implements ProductInterface
{
    use PlatesTrait;

    const TYPE = "SANDWICH";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function __construct()
    {
        $this->type = self::TYPE;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isAvailable(): bool
    {
        return true;
    }

    public function typeOf(): string
    {
        return self::TYPE;
    }


}
