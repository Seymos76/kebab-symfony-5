<?php

namespace App\Entity;

use App\Repository\BoxRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BoxRepository::class)
 */
class Box
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extraCost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExtraCost(): ?string
    {
        return $this->extraCost;
    }

    public function setExtraCost(?string $extraCost): self
    {
        $this->extraCost = $extraCost;

        return $this;
    }
}
