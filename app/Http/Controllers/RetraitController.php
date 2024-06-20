<?php

namespace App\Http\Controllers;

use App\Models\Retrait;
use Illuminate\Http\Request;

class RetraitController extends Controller
{
    public function index()
    {
        $retraits = Retrait::all();
        return response()->json($retraits);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'montant' => 'required|numeric',
            'date_retrait' => 'required|date',
        ]);

        $retrait = Retrait::create($validatedData);

        return response()->json($retrait, 201);
    }

    // Autres méthodes CRUD...
}
