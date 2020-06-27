<?php

namespace App\Entity;

use App\Repository\HomeMadeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomeMadeRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class HomeMade extends AbstractPlate
{
    use PlatesTrait;

    const TYPE = "HOMEMADE";
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
