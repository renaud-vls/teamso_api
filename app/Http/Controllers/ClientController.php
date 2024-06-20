<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:clients|max:255',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:clients',
            'fullName' => 'required|max:255',
            'phoneNumber' => 'required|unique:clients',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['identifiant'] = $this->generateIdentifiant();

        $client = Client::create($validatedData);

        // Send email with identifiant
        Mail::to($client->email)->send(new \App\Mail\ClientIdentifiantMail($client));

        return response()->json($client, 201);
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return response()->json($client);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'sometimes|required|unique:clients,username,' . $client->id . '|max:255',
            'password' => 'sometimes|required|min:8',
            'email' => 'sometimes|required|email|unique:clients,email,' . $client->id,
            'fullName' => 'sometimes|required|max:255',
            'phoneNumber' => 'sometimes|required|unique:clients,phoneNumber,' . $client->id,
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $client->update($validatedData);

        return response()->json($client, 200);
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json(null, 204);
    }

    private function generateIdentifiant()
    {
        return 'ID-' . strtoupper(uniqid());
    }
}
