<?php

namespace App\Http\Controllers;

use App\Models\Intervention;
use App\Models\Maintenance;
use App\Models\Equipment;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index()
    {
        // Jib l-interventions kolhom m3a relation dyal maintenance
        $interventions = Intervention::with('maintenance')
            ->latest('date_debut')
            ->get();

        return view('listeint', compact('interventions'));
    }
}