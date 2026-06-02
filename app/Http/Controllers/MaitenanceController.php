<?php

namespace App\Http\Controllers;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{

    public function index()
    {
        $totalMaintenances = Maintenance::count();
        $equipments = Equipment::count();
        $users = User::count();
        
        // Bedel hna: sta3mel nafs l-kitaba li 3ndek f DB
        $terminees = Maintenance::where('status', 'termine')->count(); // é machi e
        $encours = Maintenance::where('status', 'en cours')->count();  // espace machi _
        $attente = Maintenance::where('status', 'en attente')->count(); // espace machi _
        
        $monthlyMaintenances = [];
        for($i = 1; $i <= 12; $i++) {
            $monthlyMaintenances[] = Maintenance::whereMonth('date_debut', $i)->count();
        }

        return view('dashboard', compact(
            'totalMaintenances', 'equipments', 'users', 
            'terminees', 'encours', 'attente', 
            'monthlyMaintenances'
        ));
    }

    public function store(Request $request)
    {
        Maintenance::create([
            'equipment' => $request->equipment,
            'technicien' => $request->technicien,
            'date' => $request->date,
            'status' => $request->status,
        ]);

        return redirect('/dashboard');
    }



    public function destroy($id)
    {
        Maintenance::findOrFail($id)->delete();

        return redirect('/dashboard');
    }

}

