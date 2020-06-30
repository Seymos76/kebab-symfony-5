<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CartItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CartItemRepository::class)
 */
class CartItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Plate::class, inversedBy="cartItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Ordering::class, inversedBy="cartItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ordering;

    public function __construct(Plate $plate, ?int $quantity = 1)
    {
        $this->plate = $plate;
        if ($quantity) $this->quantity = $quantity;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Plate
    {
        return $this->product;
    }

    public function setProduct(?Plate $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getOrdering(): ?Ordering
    {
        return $this->ordering;
    }

    public function setOrdering(?Ordering $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }
}
