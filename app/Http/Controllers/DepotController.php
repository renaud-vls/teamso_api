<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    public function index()
    {
        $depots = Depot::all();
        return response()->json($depots);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'montant' => 'required|numeric',
            'date_depot' => 'required|date',
        ]);

        $depot = Depot::create($validatedData);

        return response()->json($depot, 201);
    }

    // Autres méthodes CRUD...
}
