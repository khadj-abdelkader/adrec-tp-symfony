<?php

namespace App\Controller;

use App\Form\ContactType;
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
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function __invoke(Mailer $mailer, Request $request): Response
    {

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $mailer->send(
                'theau@drosalys.fr',
                'Mails/first_mail.html.twig',
                $data,
                $data['email']
            );
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
