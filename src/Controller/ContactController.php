<?php

namespace App\Controller;


use App\Service\Mail;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash(
                'success',
                'Merci de nous avoir contacté, nous allons vous répondre dans les meilleurs délais.'
            );

            // On envoi le message
            $content = $this->renderview('contact/message.html.twig', [
                'form' => $form->getData()
            ]);
            $mail = new Mail();
            $mail->send('europe4strays@nevertoolate.fr', 'Europe4strays', 'Vous avez reçu une nouveau message', $content);
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
