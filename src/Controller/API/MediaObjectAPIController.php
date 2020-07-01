<?php


namespace App\Controller\API;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MediaObjectAPIController
 * @package App\Controller\API
 * @Route(path="/apic/media")
 */
class MediaObjectAPIController extends AbstractController
{
    /**
     * @Route(path="/create", name="api_media_create", methods={"POST"})
     * @param Request $request
     */
    public function addImage(Request $request)
    {
        $base64Image = $request->files->get('file');
        dd($base64Image);
    }

}
