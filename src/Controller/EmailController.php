<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    #[Route('/email', name: 'app_email')]
    public function email(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('xxx@xxx.com')
            ->to('xxx@xxx.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);
        exit('email sent');
    }

    #[Route('/send-email', name: 'app_send_email')]
    public function sendEmail(NotifierInterface $notifier): Response
    {
        $notification = (new Notification('New Invoice', ['email']))
            ->content('You got a new invoice for 15 EUR.');

        // The receiver of the Notification
        $recipient = new Recipient(
            'xxx@xxx.com',
            null
        );

        // Send the notification to the recipient
        $notifier->send($notification, $recipient);

        exit('email sent');
    }
}
