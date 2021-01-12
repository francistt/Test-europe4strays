<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Entity\Images;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * Permet de créer une annonce
     * 
     * @Route("/ads/new", name="ads_create")
     * @IsGranted("ROLE_USER")
     *
     * @return Response
     */
    public function create(Request $request,EntityManagerInterface $manager){
        $ad = new Ad();

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            
         
             // On récupère l'image transmise
             $picture = $form->get('coverImage')->getData();
             // On génère un nom de fichier
             $fichier = md5(uniqid()) . '.' . $picture->guessExtension();
             // On copie le fichier dans le dossier uploads
             $picture->move(
                 $this->getParameter('images_directory'),
                 $fichier
             );
             // On stocke le nom de l'image dans la BDD
                 $ad->setCoverImage($fichier);



                    // On récupère l'image transmise
                    $images = $form->get('images2')->getData();

                    // On boucle sur les images
                    foreach($images as $image){
                        // On génère un nom de fichier
                        $fichier = md5(uniqid()) . '.' . $image->guessExtension();             
                    }
                    // On copie le fichier dans le dossier uploads
                    $image->move(
                        $this->getParameter('images_directory'),
                        $fichier
                    );
                    // On stocke le nom de l'image dans la BDD
                        $img = new Images();
                        $img->setName($fichier);
                        $ad->addImages2($img);





            //foreach($ad->getImages() as $image) {
            //    $image->setAd($ad);
            //    $manager->persist($image);
            //}

            $ad->setAuthor($this->getUser());

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getName()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);
        }

        return $this->render('ad/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'édition
     *
     * @Route("/ads/{slug}/edit", name="ads_edit")
     * @Security("is_granted('ROLE_USER') and user === ad.getAuthor()", message="cette annonce ne vous appartient pas, vous ne pouvez pas la modifier")
     * 
     * @return Response
     */
    public function edit(Ad $ad, Request $request, EntityManagerInterface $manager){
        
        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            
            // On récupère l'image transmise
            $picture = $form->get('coverImage')->getData();

            if($picture){
                // On génère un nom de fichier
                $fichier = md5(uniqid()) . '.' . $picture->guessExtension();
                // On copie le fichier dans le dossier uploads
                $picture->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On stocke le nom de l'image dans la BDD
                    $ad->setCoverImage($fichier);
            }





            // On récupère l'image transmise
            $images = $form->get('images2')->getData();

            if($images){
                // On boucle sur les images
                foreach($images as $image){
                    // On génère un nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();             
                }
                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                // On stocke le nom de l'image dans la BDD
                    $img = new Images();
                    $img->setName($fichier);
                    $ad->addImages2($img);
            }





            //foreach($ad->getImages() as $image) {
            //    $image->setAd($ad);
            //    $manager->persist($image);
            //}

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les modifications de l'annonce <strong>{$ad->getName()}</strong> ont bien été enregistrées !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug()
            ]);
        }

        return $this->render('ad/edit.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     * 
     * @Route("/ads/{slug}", name="ads_show")
     *
     * @return Response
     */
    public function show(Ad $ad)
    {
        return $this->render('ad/show.html.twig', [
            'ad' => $ad
        ]);
    }

    /**
     * Permet de supprimer une annonce
     * 
     * @Route("/ads/{slug}/delete", name="ads_delete")
     * @Security("is_granted('ROLE_USER') and user === ad.getAuthor()", message="Vous n'avez pas le droit d'accéder à cette ressource")
     *
     * @param Ad $ad
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Ad $ad, EntityManagerInterface $manager) {
        $manager->remove($ad);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'annonce <strong>{$ad->getName()}</strong> a bien été supprimé !"
        );

        return $this->redirectToRoute("ads_index");
    }


        /**
     * Permet d'effacer l'image de profil
     * @Route("/supprime/ad_image/{id}", name="ad_delete_image", methods={"DELETE", "GET"})
     * 
     */
    public function deletePicture(Images $image, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            // On vérifie le nom de l'image
            $nom = $image->getName();
            // On supprime le fichier
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime l'entrée de la BDD
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);       
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }
}

