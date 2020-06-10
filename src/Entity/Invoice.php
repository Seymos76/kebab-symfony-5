<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Ordering;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice extends Ordering
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity=Ordering::class, inversedBy="invoices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ordering;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrdering(): ?Ordering
    {
        return $this->ordering;
    }

    public function setOrdering(?Ordering $ordering): self
    {
        $this->ordering = $ordering;

        return $this;
    }
}
