<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class AbstractPlate
{
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    protected $label;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"public"})
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $slug;

    /**
     * @var File|null
     *
     * @ORM\ManyToOne(targetEntity=MediaObject::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"public"})
     */
    protected $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extraCost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
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

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function getImage(): ?File
    {
        return $this->image;
    }

    public function setImage(?File $image): self
    {
        $this->image = $image;

        return $this;
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
