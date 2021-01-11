<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\Pagination;
use App\Service\StatsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/users/{page<\d+>?1}", name="admin_user_index")
     */
    public function index($page, Pagination $pagination, StatsService $statsService)
    {
        $stats = $statsService->getStats();

        $pagination->setEntityClass(User::class)
            ->setPage($page);

        return $this->render('admin/user/index.html.twig', [
            'pagination' => $pagination,
            'stats' => $stats
        ]);
    }

    /**
     * Permet de supprimer un utilisateur
     *
     * @Route("/admin/users/{id}/delete", name="admin_users_delete")
     * 
     * @param User $user
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(User $user, EntityManagerInterface $manager)
    {
        if (count($user->getAds()) > 0) {
            $this->addFlash(
                'danger',
                "Vous ne pouvez pas supprimer l'utilisateur <strong>{$user->getFullName()}</strong> car il possède déjà des annonces. Veuillez d'abord supprimer ses annonces."
            );
        } else {
            $manager->remove($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'utilisateur <strong>{$user->getFullName()}</strong> a bien été supprmiée."

            );
        }
        return $this->redirectToRoute('admin_user_index');
    }
}
