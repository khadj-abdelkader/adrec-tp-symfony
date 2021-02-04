<?php


namespace App\Service;


use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Twig\Environment;

class Mailer
{
    private string $mailSender;
    private string $mailSenderName;
    private MailerInterface $mailer;
    private Environment $twig;

    /**
     * Mailer constructor.
     * @param string $mailSender
     * @param string $mailSenderName
     * @param MailerInterface $mailer
     * @param Environment $twig
     */
    public function __construct(string $mailSender, string $mailSenderName, MailerInterface $mailer, Environment $twig)
    {
        $this->mailSender = $mailSender;
        $this->mailSenderName = $mailSenderName;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }


    /**
     * @param $to
     * @param string $subject
     * @param string $template Chemin depuis le dossier template
     * @param array|null $vars
     * @param null $from
     * @throws TransportExceptionInterface
     */
    public function send($to, string $template, ?array $vars = null, $from = null)
    {

        if(null === $from) {
            $from = new Address($this->mailSender, $this->mailSenderName);
        }

        $template = $this->twig->resolveTemplate($template);

        $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            ->subject($template->renderBlock('subject', $vars))
            ->html($template->renderBlock('content', $vars))
//            ->text($template->renderBlock('text', $vars))
        ;

        $this->mailer->send($email);
    }
}
