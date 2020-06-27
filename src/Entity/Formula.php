<?php

namespace App\Entity;

use App\Repository\FormulaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormulaRepository::class)
 */
class Formula extends AbstractPlate
{
    use PlatesTrait;

    const TYPE = "FORMULA";
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

}
