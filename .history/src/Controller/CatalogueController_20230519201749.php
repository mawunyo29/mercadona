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

    #[Route('/catalogue', name: 'app_catalogue')]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        
        $data =  new SearchData();
        if($request->query->get('order')){
            $data->order= $request->query->get('order');
        }
        if($request->query->get('sort')){
            $data->sort= $request->query->get('sort');
        }
        if($request->query->get('price')){
            $data->price= $request->query->get('search');
        }
        $form = $this->createForm(SearchType::class, $data);

        $form->handleRequest($request);

        $products = $productRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {

            // Effectuer la recherche dans la source de données
            // Récupérer les résultats de la recherche
            $products = $productRepository->findByWordingField($data);
          
        }

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
}
