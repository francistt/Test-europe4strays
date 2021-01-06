<?php

namespace App\Controller;

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
     * @Route("/hosting", name="hosting")
     *
     * @return void
     */
    public function hosting()
    {
        return $this->render(
            'hosting.html.twig'
        );
    }

    /**
     * @Route("/us", name="us")
     *
     * @return void
     */
    public function us()
    {
        return $this->render(
            'us.html.twig'
        );
    }

     /**
     * @Route("/donate", name="donate")
     *
     * @return void
     */
    public function donate()
    {
        return $this->render(
            'donate.html.twig'
        );
    }
}

?>