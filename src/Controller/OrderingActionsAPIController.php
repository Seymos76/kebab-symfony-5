<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderingActionsAPIController extends AbstractController
{
    public function validateOrdering()
    {
        // get customer email
        // get customer payment info
        // checkout payment
        // handle checkout
        // create invoice
        // send invoice by email
        // send ordering confirmation by email
        // save to database
        // return json
    }

    public function orderAgain()
    {
        // get order from database
        // clone it
        // validate ordering()
    }
}