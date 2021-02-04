<?php


namespace App\Service;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class Mailer
{
    private MailerInterface $mailer;

    /**
     * Mailer constructor.
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    public function send()
    {
        $email = (new TemplatedEmail())
            ->from('adrec@drosalys.net')
            ->to(new Address('theau@drosalys.fr'))
            ->subject('Thanks for signing up!')

            // path of the Twig template to render
            ->htmlTemplate('Mails/first_mail.html.twig')
        ;

        $this->mailer->send($email);
    }
}
