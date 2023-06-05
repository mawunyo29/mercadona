<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Promotion;
use App\Event\ProductEndPromotionEvent;
use App\Form\SearchType;
use App\Model\SearchData;
use App\Repository\ProductRepository;
use PHPUnit\Framework\Constraint\IsEmpty;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

use function PHPUnit\Framework\isEmpty;

class CatalogueController extends AbstractController
{
    protected $promotion;
    #[Route('/catalogue', name: 'app_catalogue')]
    public function index(ProductRepository $productRepository, Request $request, EventDispatcherInterface $eventDispatcherInterface,): Response
    {
        //promotion where date end < now

        $data =  new SearchData();
        if ($request->query->get('order')) {
            $data->order = $request->query->get('order');
        }
        if ($request->query->get('sort')) {
            $data->sort = $request->query->get('sort');
        }
        if ($request->query->get('price')) {
            $data->price = $request->query->get('search');
        }
        $form = $this->createForm(SearchType::class, $data);

        $form->handleRequest($request);

        $products = $productRepository->findAll();

        $promotions = $productRepository->findPromotion();
        // chech is promotions is empty

        if ($promotions != []) {
            foreach ($promotions as $promotion) {
                $eventDispatcherInterface->dispatch(new ProductEndPromotionEvent($promotion));
            }
        }


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

    #[Route('/catalogue/product/{id}', name: 'app_catalogue_download', methods: ['POST'] , priority: 20)]
    public function downloadImage(Product $product): Response
    {
        dd($product);
        $file = $product->getImageName();
        //transformer le nom du fichier en image  et et créer un fichier temporaire temporaire qui sera supprimé à la fin de la requête
         $file = tempnam(sys_get_temp_dir(), $product->getImageName());
        $response = new BinaryFileResponse($file);
        //charger le fichier dans la réponse dans le header
        $response->headers->set('Content-Type', 'image/jpeg');
        //afficher dans la baliise img du twig
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE, $product->getImageName());
        dd($response);
        return $response;

    }
}
