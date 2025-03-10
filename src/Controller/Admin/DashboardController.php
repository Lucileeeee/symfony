<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\Article;
use App\Entity\Account;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Routing\Attribute\Route;



#[AdminDashboard(routePath:'/enigma', routeName: 'app_admin_dashboard')]
class DashboardController extends AbstractDashboardController{
    
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator){} 

// modifier la méthode index comme ci-dessous :
    #[Route('/admin', name: 'admin_cat')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
        ->setController(CategoryCrudController::class)
        ->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MenuDashboard');
    }

    public function configureMenuItems(): iterable
    {//nom de l'entity, pas de la bdd
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Articles', 'fa-solid fa-newspaper', Article::class);
        yield MenuItem::linkToCrud('Comptes', 'fa-solid fa-users', Account::class);
        yield MenuItem::linkToCrud('Categories', 'fa-solid fa-list', Category::class);
    
    }
}
