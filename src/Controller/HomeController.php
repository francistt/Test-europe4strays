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
        dd($pages);
        return $this->render(
            'home.html.twig',
            [
                'pages' => $pages,
            ]
        );
    }

    /**
    * @Route("/page1", name="page1")
    *
    * @return void
    */
    public function page1()
    {
        $type = Page::PAGE1;
        $page1 = $this->entityManager->getRepository(Page::class)->findBy(['type' => $type]);
        return $this->render(
            "pages/$type.html.twig",
            [
                'page1' => $page1
            ]
        );
    }

    /**
     * @Route("/page2", name="page2")
     *
     * @return void
     */
    public function page2()
    {
        $type = Page::PAGE2;
        $page2 = $this->entityManager->getRepository(Page::class)->findBy(['type' => $type]);
        return $this->render(
            'pages/page2.html.twig',
            [
                'page2' => $page2
            ]
        );
    }

    /**
     * @Route("/page3", name="page3")
     *
     * @return void
     */
    public function page3()
    {
        $type = Page::PAGE3;
        $page3 = $this->entityManager->getRepository(Page::class)->findBy(['type' => $type]);
        return $this->render(
            'pages/page3.html.twig',
            [
                'page3' => $page3
            ]
        );
    }
}

?>