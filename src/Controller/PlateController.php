<?php

namespace App\Controller;

use App\Entity\Plate;
use App\Form\PlateType;
use App\Generator\UniqueFileNameGenerator;
use App\Repository\PlateRepository;
use App\Uploader\ImageUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plate")
 */
class PlateController extends AbstractController
{
    /**
     * @Route("/", name="plate_index", methods={"GET"})
     */
    public function index(PlateRepository $plateRepository): Response
    {
        return $this->render('plate/index.html.twig', [
            'plates' => $plateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="plate_new", methods={"GET","POST"})
     */
    public function new(Request $request, ImageUploader $imageUploader): Response
    {
        $plate = new Plate();
        $form = $this->createForm(PlateType::class, $plate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form['image']->getData();
            $fileName = $imageUploader->handleFileUpload($brochureFile, $this->getParameter('upload_plates'));
            $plate->setImage($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plate);
            $entityManager->flush();
            return $this->redirectToRoute('plate_index');
        }

        return $this->render('plate/new.html.twig', [
            'plate' => $plate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/plate/show/{id}", name="plate_show", methods={"GET"})
     */
    public function show(Plate $plate): Response
    {
        return $this->render('plate/show.html.twig', [
            'plate' => $plate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plate_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plate $plate, ImageUploader $imageUploader): Response
    {
        $form = $this->createForm(PlateType::class, $plate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form['image']->getData();
            $fileName = $imageUploader->handleFileUpload($brochureFile, $this->getParameter('upload_plates'));
            $plate->setImage($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plate_index');
        }

        return $this->render('plate/edit.html.twig', [
            'plate' => $plate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plate_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Plate $plate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plate_index');
    }
}
