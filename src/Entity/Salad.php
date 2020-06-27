<?php

namespace App\Entity;

use App\Repository\SaladRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SaladRepository::class)
 */
class Salad extends AbstractPlate
{
    use PlatesTrait;

    const TYPE = "SALAD";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    public static function create()
    {
        return new self();
    }

    public function __construct()
    {
        $this->type = self::TYPE;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
