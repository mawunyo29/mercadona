<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Promotion;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;
    public function __construct( AdminUrlGenerator $adminUrlGenerator)
    {
       $this->adminUrlGenerator = $adminUrlGenerator;
    }
   
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        $url = $this->redirect($this->adminUrlGenerator->setController(ProductCrudController::class)->generateUrl());
        return $this->redirect( $url);

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mercadona');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::subMenu('Actions', 'fa fa-list')->setSubItems([
            MenuItem::linkToCrud('Catégorie', 'fas fa-list', Category::class),
            MenuItem::linkToCrud('Produits', 'fas fa-list', Product::class),
            MenuItem::linkToCrud('Promotion', 'fa-light fa-percent', Promotion::class),
        ]);
        

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}