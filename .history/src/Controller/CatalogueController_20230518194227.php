<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    #[Route('/', name: 'app_catalogue')]
    public function index(): Response
    {
        $products = $this->getDoctrine()->getRepository('App:Product')->findAll();
        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'products' => $products
        ]);
    }


}
