<?php

namespace App\Entity;

use App\Interfaces\SluggableInterface;
use App\Repository\ProductCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProductCategoryRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class ProductCategory
{
    use PlatesTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    private $slug;

    public static function create(string $label): ProductCategory
    {
        $category = new self();
        $category->setLabel($label);
        $category->setSlug($category->getStringSlug($label));
        return $category;
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

    public function setSlug(?string $slug): self
    {
        $this->slug = $this->getStringSlug($slug);

        return $this;
    }
}
