<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientRegistration;
use Illuminate\Http\Request;
use App\Notifications\SendClientIdNotification;

class AdminController extends Controller
{
    public function index()
    {
        $registrations = ClientRegistration::all();
        return view('admin.registrations.index', compact('registrations'));
    }

    public function approve($id)
    {
        $registration = ClientRegistration::findOrFail($id);

        $client = Client::create([
            'username' => $registration->username,
            'password' => $registration->password,
            'email' => $registration->email,
            'fullname' => $registration->fullName,
            'phoneNumber' => $registration->phoneNumber,
            'identifiant' => 'CLI-' . str_pad($registration->id, 6, '0', STR_PAD_LEFT),
        ]);

        $client->notify(new SendClientIdNotification($client));

        $registration->delete();

        return redirect()->back()->with('message', 'Client approuvé et identifiant envoyé');
    }

    public function ClientIdentifiantEmail($client)
    {
        $data = [
            'username' => $client->username,
            'identifiant' => $client->identifiant,
        ];

        Mail::send('emails.client_identifiant', $data, function ($message) use ($client) {
            $message->to($client->email);
            $message->subject('Votre identifiant');
        });
    }

    public function showRegistrations()
   {
        $registrations = ClientRegistration::all();
        return view('admin.registrations', compact('registrations'));
    }

}

