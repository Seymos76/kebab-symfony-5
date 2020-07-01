<?php


namespace App\Controller\API;


use App\Ecommerce\Products\PlateCreator;
use App\Entity\Plate;
use App\Repository\PlateRepository;
use App\Uploader\Base64FileExtractor;
use App\Uploader\FileRegistrator;
use App\Uploader\ImageUploader;
use App\Uploader\UploadedBase64File;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class PlatesAPIController
 * @package App\Controller\API
 * @Route(path="/apic/plates")
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
     * @Route(path="/add", name="api_plate_create", methods={"POST"})
     * @param Request $request
     */
    public function createPlate(
        Request $request,
        PlateCreator $plateCreator, FileRegistrator $fileRegistrator)
    {
        $content = json_decode($request->getContent(), true);
        /** @var Plate $plate */
        $plate = $plateCreator->createProduct($content);
        //dump('plate',$plate);
        $base64File = $content["image"];
        //dump('base64File',$base64File);
        $slug = (new Slugify())->slugify($content["label"]);
        $imageFile = $fileRegistrator->get($base64File, $slug);
        //dump('uploadedbase64file',$imageFile);
        //$newPlate = $this->serializer->deserialize($request->getContent(), Plate::class, 'json', $this->context);
        //dump('newPlate serialized',$newPlate);
        if ($plate) {
            // upload image
            $fileName = $this->imageUploader->upload($imageFile);
            // set image
            $plate->setImage($imageFile);
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
