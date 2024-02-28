<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\DataPrivacy;
use App\Entity\Game;
use App\Entity\Impress;
use App\Entity\Rules;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(GameCrudController::class)->generateUrl();
        
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Scoreboard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'startpage');
        yield MenuItem::linkToCrud('Games', 'fas fa-list', Game::Class);
        yield MenuItem::linkToCrud('Categorys', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Rules', 'fas fa-list', Rules::class);
        yield MenuItem::linkToCrud('Impress', 'fas fa-list', Impress::class);
        yield MenuItem::linkToCrud('Data Privacy', 'fas fa-list', DataPrivacy::class);
    }
}
