<?php


namespace App\Controller\API;


use App\Ecommerce\Products\PlateCreator;
use App\Entity\AbstractPlate;
use App\Entity\Plate;
use App\Repository\PlateRepository;
use App\Uploader\ImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class PlatesAPIController
 * @package App\Controller\API
 * @Route(path="/api/v2/plates")
 */
class PlatesAPIController extends AbstractController
{
    private $serializer;
    private $entityManager;
    private $imageUploader;
    private $context = [];

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager, ImageUploader $imageUploader)
    {
        $this->serializer = $serializer;
        $this->entityManager = $entityManager;
        $this->imageUploader = $imageUploader;
        $this->context = ['groups' => ['public']];
    }

    /**
     * @Route(path="/", name="api_plates", methods={"GET"})
     * @param PlateRepository $plateRepository
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function plates(PlateRepository $plateRepository)
    {
        $data = $plateRepository->findAll();
        if (sizeof($data) > 0) {
            $json = $this->serializer->serialize($data, 'json', $this->getContext());
            $status = Response::HTTP_OK;
            $headers = [];
        } else {
            $json = $this->serializer->serialize($data, 'json', $this->getContext());
            $status = Response::HTTP_NOT_FOUND;
            $headers = [];
        }
        return new JsonResponse($json, $status, $headers, false);
    }

    /**
     * @Route(path="/add", name="", methods={"POST"})
     * @param Request $request
     */
    public function createPlate(Request $request, PlateCreator $plateCreator)
    {
        $context = $this->getContext();
        $file = $request->files->get('file');
        dump($file);
        $content = json_decode($request->getContent(), true);
        dump($content);
        $plate = $plateCreator->createProduct($content['plate']);
        //$newPlate = $this->serializer->deserialize($request->getContent(), Plate::class, 'json', $context);
        if ($plate) {
            die('here');
            // upload image
            /** @var UploadedFile $brochureFile */
            $brochureFile = $newPlate['image'];
            $fileName = $this->imageUploader->handleFileUpload($brochureFile, $this->getParameter('upload_plates'));
            // set image
            $plate->setImage($fileName);
            // save Plate
            $this->entityManager->persist($plate);
            $this->entityManager->flush();
            // return json
            return new JsonResponse('', Response::HTTP_CREATED, [], true);
        } else {
            return new JsonResponse('', Response::HTTP_NOT_FOUND, []);
        }
    }

    /**
     * @return array[]
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @param array[] $context
     */
    public function setContext(array $context): void
    {
        $this->context = $context;
    }
}
