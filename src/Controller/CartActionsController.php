<?php
namespace App\Controller;

use App\Entity\Ordering;
use App\Repository\OrderingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class CartActionsController extends AbstractController
{
    private $serializer;
    private $manager;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $manager)
    {
        $this->serializer = $serializer;
        $this->manager = $manager;
    }

    /**
     * @Route(path="/api/cart/add", name="api_cart_add", methods={"GET", "POST"})
     */
    public function addToCart(Request $request)
    {
        // get product id
        $requestContent = $request->getContent();
        // deserialize content
        $deserialized = json_decode($requestContent, false);
        //$deserialized = $this->serializer->deserialize($requestContent, '', 'json', $context = []);
        //dd($deserialized);
        // create order OR get current ordering by number
        $ordering = new Ordering();
        // add product if not in array
        $ordering->addProduct(['id' => $deserialized->id, 'qty' => $deserialized->qty]);
        // save to database
        $this->manager->persist($ordering);
        $this->manager->flush();
        // prepare jsonResponse ?
        $data = [
            'message' => "Add to cart controller",
            'ordering' => $ordering->getNumber()
        ];
        $serialized = $this->serializer->serialize($data, 'json', ['groups' => ['public']]);
        // return json
        return new JsonResponse($serialized, 200, [], true);
    }

    /**
     * @Route(path="/api/cart/{number}", name="api_cart_content", methods={"GET", "POST"})
     */
    public function getCartContent(OrderingRepository $orderingRepository, Request $request)
    {
        $orderingNumber = $request->attributes->get('number');
        $ordering = $orderingRepository->findOneBy(['number' => $orderingNumber]);
        dd($ordering);
        return $this->json($orderingNumber, 200, [], ['groups' => ['public']]);
    }

    /**
     * @Route(path="/cart/remove/{id}", name="api_cart_remove")
     */
    public function removeFromCart()
    {
        // get product id
        // get current ordering by number
        // remove product if in array
        // save to database
        // return json
    }

    public function emptyCart()
    {
        // get current ordering by number
        // empty array
        // save to database OR delete ordering
        // return json
    }

    public function changeProductQuantity()
    {
        // get current ordering by number
        // find product in array
        // change quantity
        // save to database
        // return json
    }


}