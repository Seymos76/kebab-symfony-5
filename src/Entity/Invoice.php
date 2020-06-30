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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pdf;

    public function __construct(Ordering $ordering)
    {
        parent::__construct();
        $this->ordering = $ordering;
    }

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

    public function getPdf(): ?string
    {
        return $this->pdf;
    }

    public function setPdf(string $pdf): self
    {
        $this->pdf = $pdf;

        return $this;
    }
}
