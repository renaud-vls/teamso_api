<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'montant' => 'required|numeric',
            'type' => 'required|string',
            'date_transaction' => 'required|date',
        ]);

        $transaction = Transaction::create($validatedData);

        return response()->json($transaction, 201);
    }

    // Autres méthodes CRUD...
}
