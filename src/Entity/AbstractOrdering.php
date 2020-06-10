<?php

namespace App\Entity;

use App\Repository\OrderingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OrderingRepository::class)
 */
abstract class AbstractOrdering
{
    protected const TVA = 0.2;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"public"})
     */
    protected $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    abstract public function addInvoice(Invoice $invoice): self;

    abstract public function removeInvoice(Invoice $invoice): self;
}
