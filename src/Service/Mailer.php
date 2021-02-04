<?php


namespace App\Service;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class Mailer
{
    private string $mailSender;
    private string $mailSenderName;
    private MailerInterface $mailer;

    /**
     * Mailer constructor.
     * @param string $mailSender
     * @param string $mailSenderName
     * @param MailerInterface $mailer
     */
    public function __construct(string $mailSender, string $mailSenderName, MailerInterface $mailer)
    {
        $this->mailSender = $mailSender;
        $this->mailSenderName = $mailSenderName;
        $this->mailer = $mailer;
    }


    /**
     * @param $to
     * @param string $subject
     * @param string $template Chemin depuis le dossier template
     * @param array|null $vars
     * @param null $from
     * @throws TransportExceptionInterface
     */
    public function send($to, string $subject, string $template, ?array $vars = null, $from = null)
    {

        if(null === $from) {
            $from = new Address($this->mailSender, $this->mailSenderName);
        }

        $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($subject)

            // path of the Twig template to render
            ->htmlTemplate($template)
        ;

        $this->mailer->send($email);
    }
}
