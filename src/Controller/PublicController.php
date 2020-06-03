<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController {

    /**
     * Returns Home
     * @Route(path="/", name="public_homepage")
     */
    public function homepage()
    {
        return $this->render('public/index.html.twig');
    }
}