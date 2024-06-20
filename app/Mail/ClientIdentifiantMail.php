<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientIdentifiantMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function build()
    {
        return $this->view('emails.client_identifiant')
                    ->with([
                        'username' => $this->client->username,
                        'identifiant' => $this->client->identifiant,
                    ]);
    }
}
