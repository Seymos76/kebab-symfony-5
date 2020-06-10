<?php
namespace App\Ecommerce\Ordering;

class OrderingAdapter 
{
    private OrderingInterface $ordering;

    public function __construct(OrderingInterface $ordering)
    {
        $this->ordering = $ordering;
    }

    
}