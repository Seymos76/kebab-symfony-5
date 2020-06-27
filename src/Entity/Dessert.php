<?php

namespace App\Entity;

use App\Repository\DessertRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DessertRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Dessert extends AbstractPlate
{
    use PlatesTrait;

    const TYPE = "DESSERT";
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function __construct(?string $label)
    {
        if ($label && null !== $label) {
            $this->label = $label;
            $this->slug = $this->getStringSlug($label);
        }
        $this->type = self::TYPE;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
