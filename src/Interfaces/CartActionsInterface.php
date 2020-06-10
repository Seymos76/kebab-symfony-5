<?php
namespace App\Interfaces;

use Symfony\Component\HttpFoundation\JsonResponse;

interface CartActionsInterface 
{
    public function addToCart(): JsonResponse;

    public function removeFromCart(): JsonResponse;

    public function emptyCart(): JsonResponse;

    public function changeProductQuantity(): JsonResponse;
}