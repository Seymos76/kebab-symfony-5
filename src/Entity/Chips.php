<?php

namespace App\Entity;

use App\Repository\ChipsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChipsRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Chips extends AbstractPlate
{
    use PlatesTrait;

    const TYPE = "CHIPS";
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
