<?php

namespace App\Controller;

use App\Service\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Mailer $mailer
     * @return Response
     */
    public function __invoke(Mailer $mailer): Response
    {

        $mailer->send(
            'theau@drosalys.fr',
            'Mails/first_mail.html.twig',
            [
                'name' => "Théau"
            ]
        );

        return $this->render('contact/index.html.twig', [
        ]);
    }
}
