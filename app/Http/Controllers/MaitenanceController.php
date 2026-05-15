<?php

namespace App\Http\Controllers;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{

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

