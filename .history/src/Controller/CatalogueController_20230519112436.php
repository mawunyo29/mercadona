<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogueController extends AbstractController
{
    public $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
       $this->productRepository = $productRepository;
    }
    #[Route('/catalogue', name: 'app_catalogue')]
    public function index(): Response
    {
         $products =  $this->productRepository->findAll();
        return $this->render('catalogue/index.html.twig', [  
            'products' => $products
        ]);
       
    }

    #[Route('/catalogue/{id}', name: 'app_catalogue_show')]
    public function show(Product $product): Response
    {
        return $this->render('catalogue/show.html.twig', [
            'product' => $product,
        ]);
    }

    public function search(Request $request): Response
    {
        $searchForm = $this->createForm(SearchType::class);
        $searchForm->handleRequest($request);
        $products = [];
        if ($searchForm->isSubmitted() && $searchForm->isValid()) {
            $search = $searchForm->getData()['search'];
            $products = $this->productRepository->search($search);
        }
        return $this->render('catalogue/search.html.twig', [
            'searchForm' => $searchForm->createView(),
            'products' => $products,
        ]);
    }

}
