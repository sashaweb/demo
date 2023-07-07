<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Contracts\Translation\TranslatorInterface;

class EmailService
{
    function __construct(
        private MailerInterface $mailer,
        private TranslatorInterface $translator
        ) {}

    public function sendConfirmationCode($addressTo, $domain, $confirmationCode)
    {
        $subject = $this->translator->trans('emails.confirmation.subject')  . ' :: ' . $domain ;

        $email = (new TemplatedEmail())
        ->from(new Address('info@catalog.org.ua', 'Catalog.org.ua'))
        ->to(new Address($addressTo))
        ->subject($subject)
        ->htmlTemplate('emails/confirmation.html.twig')
        ->context([
            'domain' => $domain,
            'confirmation_code' => $confirmationCode,
        ])
        ;

        $this->mailer->send($email);      
    }


    public function sendInvoice($addressTo, $domain)
    {
        $subject = $this->translator->trans('emails.invoice.subject')  . ' :: ' . $domain ;

        $email = (new TemplatedEmail())
        ->from(new Address('info@catalog.org.ua', 'Catalog.org.ua'))
        ->to(new Address($addressTo))
        ->subject($subject)
        ->htmlTemplate('emails/invoice.html.twig')
        ->context([
            'domain' => $domain,
        ])
        ;

        $this->mailer->send($email);      
    }

    public function sendAdded($addressTo, $domain)
    {
        $subject = $this->translator->trans('emails.added.subject')  . ' :: ' . $domain ;

        $email = (new TemplatedEmail())
        ->from(new Address('info@catalog.org.ua', 'Catalog.org.ua'))
        ->to(new Address($addressTo))
        ->subject($subject)
        ->htmlTemplate('emails/added.html.twig')
        ->context([
            'domain' => $domain,
        ])
        ;

        $this->mailer->send($email);      
    }

    public function sendAdminNewRequest($domain)
    {
        $subject = $domain ;

        $email = (new TemplatedEmail())
        ->from(new Address('info@catalog.org.ua', 'Catalog.org.ua'))
        ->to(new Address('sashaon@gmail.com'))
        ->subject($subject)
        ->htmlTemplate('emails/admin_new_request.html.twig')
        ->context([
            'domain' => $domain,
        ])
        ;

        $this->mailer->send($email);      
    }


}