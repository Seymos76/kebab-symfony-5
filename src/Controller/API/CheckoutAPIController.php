<?php


namespace App\Controller\API;


use App\Ecommerce\Invoice\InvoiceTrait;
use App\Entity\Invoice;
use App\Mailer\EmailGenerator;
use App\Repository\OrderingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CheckoutAPIController
 * @package App\Controller\API
 * @Route(path="/apic/checkout")
 */
class CheckoutAPIController extends AbstractController
{
    use InvoiceTrait;

    /**
     * @Route(path="/", name="api_checkout", methods={"POST"})
     */
    public function receiveCheckout(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager, OrderingRepository $orderingRepository, EmailGenerator $emailGenerator): JsonResponse
    {
        $content = $request->getContent();
        // deserialize request->getContent()
        $credentials = $serializer->deserialize($content, Invoice::class, 'json', ['groups' => 'checkout']);
        // store credentials
        // request Stripe/Lydia API
        // validate Checkout
        $ordering = $orderingRepository->findOneBy(['number' => $credentials['number']]);
        // create Invoice
        $invoice = $this->createInvoice($ordering);
        // save to db
        $entityManager->persist($invoice);
        $entityManager->flush();
        // send email with Invoice attachment
        $emailGenerator->sendEmail($credentials['email']);
        // return json
        return new JsonResponse([], Response::HTTP_OK, [], true);
    }
}
