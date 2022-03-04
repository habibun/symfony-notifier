<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Recipient\Recipient;
use Symfony\Component\Routing\Annotation\Route;

class SmsController extends AbstractController
{
    #[Route('/sms', name: 'app_sms')]
    public function index(NotifierInterface $notifier): Response
    {
        // create notification that has to be send
        $notification = (new Notification('New SMS', ['sms']))
            ->content('This is a test sms');

        // the receiver of the notification
        $recipient = new Recipient('', '+8801724595756');

        // send the notification to the recipient
        $notifier->send($notification, $recipient);
    }
}
