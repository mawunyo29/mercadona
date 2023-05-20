<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    public $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
       $this->productRepository = $productRepository;
    }
    #[Route('/', name: 'app_catalogue')]
    public function index(): Response
    {
         $products =  $this->productRepository->findAll();
        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            
        ]);
    }


}
