<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request): Response
    {
        $searchData = new SearchData();
        $form = $this->createForm(SearchType::class ,SearchData::class);
        $form->handleRequest($request);

        $products = [];

        if ($form->isSubmitted() && $form->isValid()) {
            dd($searchData);
            // Effectuer la recherche dans la source de données
            // Récupérer les résultats de la recherche
            $products = $this->productRepository->findByWordingField($searchData);
        }
         $products =  $this->productRepository->findAll();
        return $this->render('catalogue/index.html.twig', [  
            'products' => $products,
            'form' => $form->createView()->vars,
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
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        $results = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $searchData = $form->getData();
            // Effectuer la recherche dans la source de données
            // Récupérer les résultats de la recherche
            $results = $this->productRepository->getRepository(Product::class)->search($searchData);
        }

        return $this->render('catalogue/show.html.twig', [
            'form' => $form->createView(),
            'results' => $results,
        ]);
    }
    

}
