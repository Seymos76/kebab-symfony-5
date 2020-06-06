<?php

namespace App\Entity;

use App\Repository\ProductCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Plate;

/**
 * @ORM\Entity(repositoryClass=ProductCategoryRepository::class)
 */
class ProductCategory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plate", mappedBy="product_category")
     */
    private $plates;

    public function __construct()
    {
        $this->plates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getPlates()
    {
        return $this->plates;
    }

    public function addPlate(Plate $plate): self
    {
        if (!$this->plates->contains($plate)) {
            $this->plates->add($plate);
            $plate->setProductCategory($this);
            return $this;
        }
    }

    public function removePlate(Plate $plate): self
    {
        if($this->plates->contains($plate)) {
            $this->plates->remove($plate);
            $plate->setProductCategory(null);
            return $this;
        }
    }
}
