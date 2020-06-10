<?php
namespace App\Controller;

use App\Entity\Ordering;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderingController extends AbstractController
{
    protected $ordering;

    public function __construct()
    {
        $this->ordering = new Ordering();
    }

    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * @Route("/ordering/add/{id}", name="ordering_add_product")
     *
     * @param integer $productId
     * @return void
     */
    public function addToOrder(Request $request)
    {
        dump($request->attributes->get('id'));
        dump($this->getOrdering()->getProducts());
        $productId = (int)$request->attributes->get('id');
        $this->getOrdering()->addProduct($productId);
        return $this->redirectToRoute('ordering_summary');
    }

    /**
     * @Route("/orderings", name="ordering_summary")
     */
    public function cart(Request $request)
    {
        dump($this->getOrdering());
        return $this->render(
            'ecommerce/cart.html.twig',
            [
                'ordering' => $this->getOrdering()
            ]
        );
    }
}
