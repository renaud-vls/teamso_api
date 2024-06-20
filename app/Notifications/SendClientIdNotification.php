<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendClientIdNotification extends Notification
{
    use Queueable;

    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Bonjour ' . $this->client->username . ',')
                    ->line('Votre identifiant est : ' . $this->client->identifiant)
                    ->line('Merci d\'utiliser notre application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
