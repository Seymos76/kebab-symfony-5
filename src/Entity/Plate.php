<?php

namespace App\Entity;

use App\Repository\PlateRepository;
use Cocur\Slugify\Slugify;
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
 */
class Plate extends AbstractPlate
{
    use PlatesTrait;

    const TYPE = "PLATE";
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

    public function getType(): ?string
    {
        return $this->type;
    }
}
