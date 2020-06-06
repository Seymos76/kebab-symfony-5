<?php

namespace App\Entity;

use App\Repository\PlateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlateRepository::class)
 */
class Plate
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
    protected $label;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $yourChoice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $support;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $formula;

    /**
     * @ORM\ManyToOne(targetEntity=ProductCategory::class, inversedBy="plates")
     * @ORM\JoinColumn(name="product_category_id", referencedColumnName="id")
     */
    protected $product_category;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getYourChoice(): ?string
    {
        return $this->yourChoice;
    }

    public function setYourChoice(?string $yourChoice): self
    {
        $this->yourChoice = $yourChoice;

        return $this;
    }

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(?string $support): self
    {
        $this->support = $support;

        return $this;
    }

    public function getFormula(): ?string
    {
        return $this->formula;
    }

    public function setFormula(?string $formula): self
    {
        $this->formula = $formula;

        return $this;
    }

    public function getProductCategory(): ?ProductCategory
    {
        return $this->product_category;
    }

    public function setProductCategory(?ProductCategory $product_category): self
    {
        $this->product_category = $product_category;

        return $this;
    }
}
