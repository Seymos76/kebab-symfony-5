<?php

namespace App\Entity;

use App\Repository\SandwichRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SandwichRepository::class)
 */
class Sandwich extends AbstractPlate
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
}
