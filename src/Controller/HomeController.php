<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\WelcomePage;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function home(AdRepository $adRepo){

        $welcomePages = $this->entityManager->getRepository(WelcomePage::class)->findAll();


        return $this->render(
            'home.html.twig',
            [
                'welcomePages' => $welcomePages,
                'ads' => $adRepo->findLastAds(3)
            ]
        );
    }

    /**
     * @Route("/list", name="list")
     */
    public function list(AdRepository $adRepo){

        $pages = $this->entityManager->getRepository(Page::class)->findAll();
        
        return $this->render(
            'partials/list.html.twig',
            [
                'pages' => $pages,
            ]
        );
    }

    /**
    * @Route("/{type}", name="page")
    *
    * @return void
    */
    public function page(Page $page)
    {
        return $this->render(
            "page.html.twig",
            [
                'page' => $page
            ]
        );
    }
}
