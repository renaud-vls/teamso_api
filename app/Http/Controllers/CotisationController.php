<?php

namespace App\Http\Controllers;

use App\Models\Cotisation;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    public function index()
    {
        $cotisations = Cotisation::all();
        return response()->json($cotisations);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'montant' => 'required|numeric',
            'date_cotisation' => 'required|date',
        ]);

        $cotisation = Cotisation::create($validatedData);

        return response()->json($cotisation, 201);
    }

    // Autres méthodes CRUD...
}
