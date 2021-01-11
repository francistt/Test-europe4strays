<?php

namespace App\Controller\Admin;

use App\Entity\Ad;
use App\Entity\Page;
use App\Entity\User;
use App\Entity\WelcomePage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{

    /**
     * @Route("/admin2", name="admin2")
     */
    public function index(): Response
    {

        return $this->render('bundles/EasyAdminBundle/welcome.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Europe4strays');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Annonces', 'fas fa-paw', Ad::class);
        yield MenuItem::linkToCrud("Page d'accueuil", 'fas fa-desktop', WelcomePage::class);
        yield MenuItem::linkToCrud("Page", 'fas fa-folder', Page::class);
    }
}
