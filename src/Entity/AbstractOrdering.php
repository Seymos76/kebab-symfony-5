<?php

namespace App\Entity;

abstract class AbstractOrdering
{
    protected const TVA = 0.2;

    protected $id;

    abstract public function getId(): ?int;

    abstract public function addInvoice(Invoice $invoice): self;

    abstract public function removeInvoice(Invoice $invoice): self;
}
