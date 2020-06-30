<?php


namespace App\Ecommerce\Invoice;


use App\Entity\Invoice;
use App\Entity\Ordering;

trait InvoiceTrait
{
    public function createInvoice(Ordering $ordering): Invoice
    {
        return new Invoice($ordering);
    }
}
