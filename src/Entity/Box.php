<?php

namespace App\Entity;

use App\Repository\BoxRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BoxRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Box extends AbstractPlate
{
    use PlatesTrait;

    const TYPE = "BOX";
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
