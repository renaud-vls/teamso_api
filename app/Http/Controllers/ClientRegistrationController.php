<?php

namespace App\Http\Controllers;

use App\Models\ClientRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientRegistrationController extends Controller
{
    public function index()
    {
        $clientRegistrations = ClientRegistration::all();
        return response()->json($clientRegistrations);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|unique:client_registrations|max:255',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|same:password',
            'email' => 'required|email|unique:client_registrations',
            'fullName' => 'required|max:255',
            'phoneNumber' => 'required|unique:client_registrations',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $clientRegistration = ClientRegistration::create($validatedData);

        return response()->json($clientRegistration, 201);
    }

    public function show($id)
    {
        $clientRegistration = ClientRegistration::findOrFail($id);
        return response()->json($clientRegistration);
    }

    public function update(Request $request, $id)
    {
        $clientRegistration = ClientRegistration::findOrFail($id);

        $validatedData = $request->validate([
            'username' => 'sometimes|required|unique:client_registrations,username,' . $clientRegistration->id . '|max:255',
            'password' => 'sometimes|required|min:8',
            'confirmPassword' => 'sometimes|required|same:password',
            'email' => 'sometimes|required|email|unique:client_registrations,email,' . $clientRegistration->id,
            'fullName' => 'sometimes|required|max:255',
            'phoneNumber' => 'sometimes|required|unique:client_registrations,phoneNumber,' . $clientRegistration->id,
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $clientRegistration->update($validatedData);

        return response()->json($clientRegistration, 200);
    }

    public function destroy($id)
    {
        $clientRegistration = ClientRegistration::findOrFail($id);
        $clientRegistration->delete();
        return response()->json(null, 204);
    }
}
