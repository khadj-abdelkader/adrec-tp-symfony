<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\ContactType;
use App\Service\DateService;
use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Mailer $mailer
     * @param Request $request
     * @param DateService $dateService
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function __invoke(Mailer $mailer, Request $request, DateService $dateService): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            if( $mailer->send(
                'theau@drosalys.fr',
                'Mails/first_mail.html.twig',
                $data,
                $data['email']
            )) {
                $this->addFlash('mail_send', 'Votre message a bien été envoyé');
            } else {
                $this->addFlash('mail_not_send', "Nous n'avons pas pu envoyer le message, merci de contacter theau@drosalys.fr");
            }

            unset($form);
            $form = $this->createForm(ContactType::class);
        }

        $events = $this->getDoctrine()->getRepository(Event::class)->findAll();


        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            'events' => $events,
        ]);
    }
}
