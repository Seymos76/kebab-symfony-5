<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Interfaces\ProductInterface;
use App\Repository\PlateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=PlateRepository::class)
 *
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "plate" = "Plate",
 *     "box" = "Box",
 *     "chips" = "Chips",
 *     "dessert" = "Dessert",
 *     "entry" = "Entry",
 *     "formula" = "Formula",
 *     "homemade" = "HomeMade",
 *     "salad" = "Salad",
 *     "sandwich" = "Sandwich"
 * })
 * @ApiResource(
 *     itemOperations={
 *          "get"={"path"="/api/plates/{id}"}
 *     }
 * )
 */
class Plate extends AbstractPlate implements ProductInterface
{
    const TYPE = "PLATE";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity=CartItem::class, mappedBy="product", orphanRemoval=true)
     */
    private $cartItems;

    public function __construct()
    {
        $this->type = self::TYPE;
        $this->cartItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function isAvailable(): bool
    {
        return true;
    }

    public function typeOf(): string
    {
        return self::TYPE;
    }

    /**
     * @return Collection|CartItem[]
     */
    public function getCartItems(): Collection
    {
        return $this->cartItems;
    }

    public function addCartItem(CartItem $cartItem): self
    {
        if (!$this->cartItems->contains($cartItem)) {
            $this->cartItems[] = $cartItem;
            $cartItem->setProduct($this);
        }

        return $this;
    }

    public function removeCartItem(CartItem $cartItem): self
    {
        if ($this->cartItems->contains($cartItem)) {
            $this->cartItems->removeElement($cartItem);
            // set the owning side to null (unless already changed)
            if ($cartItem->getProduct() === $this) {
                $cartItem->setProduct(null);
            }
        }

        return $this;
    }

}
