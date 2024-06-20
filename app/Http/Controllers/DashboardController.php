<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Cotisation;
use App\Models\Retrait;
use App\Models\Depot;
use App\Models\Client;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistics = [
            'total_transactions' => Transaction::count(),
            'total_cotisations' => Cotisation::sum('montant'),
            'total_retraits' => Retrait::sum('montant'),
            'total_depots' => Depot::sum('montant'),
            'total_clients' => Client::count(),
        ];

        return response()->json($statistics);
    }
}
