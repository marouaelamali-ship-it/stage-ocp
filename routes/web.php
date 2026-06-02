<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance;
use App\Models\Equipment;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| HOME + LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => redirect('/login'));
Route::get('/login', fn() => view('auth.login'))->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/dashboard');
    }
    return back()->withErrors(['email' => 'Email ou mot de passe incorrect']);
});

Route::post('/signout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $maintenances = Maintenance::with('equipment')->latest()->paginate(5);
        $totalMaintenances = Maintenance::count();
        $termines = Maintenance::where('status', 'termine')->count();
        $encours = Maintenance::where('status', 'en cours')->count();
        $attente = Maintenance::where('status', 'en attente')->count();
        $equipments = Equipment::count();
        $users = \App\Models\User::count();

        $monthlyMaintenances = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyMaintenances[] = Maintenance::whereMonth('created_at', $month)->count();
        }

        $topEquipments = Equipment::withCount('maintenances')
            ->orderByDesc('maintenances_count')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'maintenances','totalMaintenances','termines','encours','attente',
            'equipments','users','monthlyMaintenances','topEquipments'
        ));
    });

    /*
    |--------------------------------------------------------------------------
    | EQUIPMENTS - 2 PAGES M9ADIN
    |--------------------------------------------------------------------------
    */
    
    // 1. PAGE AJOUTER - equipements.blade.php
    Route::get('/equipments', function () {
        $totalEquipments = Equipment::count();
        $disponibles = Equipment::where('status', 'Disponible')->count();
        $maintenance = Equipment::where('status', 'Maintenance')->count();
        $critiques = Equipment::where('status', 'Critique')->count();

        return view('equipments', compact('totalEquipments','disponibles','maintenance','critiques'));
    });

    // 2. PAGE LISTE + STATS - eListe.blade.php  
    Route::get('/eListe', function () {
        $equipments = Equipment::latest()->paginate(10);
        $totalEquipments = Equipment::count();
        $disponibles = Equipment::where('status', 'Disponible')->count();
        $maintenance = Equipment::where('status', 'Maintenance')->count();
        $critiques = Equipment::where('status', 'Critique')->count();

        return view('eListe', compact('equipments','totalEquipments','disponibles','maintenance','critiques'));
    })->name('equipments.index');

    // 3. STORE EQUIPMENT
    Route::post('/equipments', function (Request $request) {
        if(auth()->user()->role != 'admin') abort(403);
        
        $imageName = null;
        if($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
        }

        Equipment::create([
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
            'reference' => $request->reference,
            'image' => $imageName,
        ]);

        return redirect('/equipments')->with('success', 'Equipement ajouté');
    });

    // 4. DELETE EQUIPMENT
    Route::delete('/equipments/{id}', function ($id) {
        if(auth()->user()->role != 'admin') abort(403);
        Equipment::findOrFail($id)->delete();
        return back()->with('delete', 'Équipement supprimé');
    });

    // 5. UPDATE EQUIPMENT
    Route::put('/equipments/{id}', function (Request $request, $id) {
        if(auth()->user()->role != 'admin') abort(403);
        $equipment = Equipment::findOrFail($id);
        $equipment->update([
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
        ]);
        return redirect('/eListe')->with('update', 'Équipement modifié');
    });

    /*
    |--------------------------------------------------------------------------
    | MAINTENANCES - B7AL MA HOM
    |--------------------------------------------------------------------------
    */
    Route::get('/maintenances', function () {
        $equipments = Equipment::all();
        return view('maintenance', compact('equipments'));
    });

    Route::get('/mListe', function () {
        $maintenances = Maintenance::with('equipment')->latest()->paginate(10);
        return view('mListe', compact('maintenances'));
    });

    Route::post('/maintenances', function (Request $request) {
        if(auth()->user()->role != 'admin') abort(403);
        Maintenance::create([
            'equipment_id' => $request->equipment_id,
            'type' => 'corrective',
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return redirect('/dashboard')->with('success', 'Maintenance ajoutée');
    });

    Route::delete('/maintenances/{id}', function ($id) {
        if(auth()->user()->role != 'admin') abort(403);
        Maintenance::findOrFail($id)->delete();
        return redirect('/dashboard')->with('delete', 'Maintenance supprimée');
    });

    Route::get('/maintenances/{id}/edit', function ($id) {
        if(auth()->user()->role != 'admin') abort(403);
        $maintenance = Maintenance::findOrFail($id);
        $equipments = Equipment::all();
        return view('edit-maintenance', compact('maintenance', 'equipments'));
    });

    Route::put('/maintenances/{id}', function (Request $request, $id) {
        if(auth()->user()->role != 'admin') abort(403);
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->update([
            'equipment_id' => $request->equipment_id,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return redirect('/dashboard')->with('success', 'Maintenance mise à jour');
    });

    Route::get('/export-pdf', function () {
        $maintenances = Maintenance::all();
        $pdf = Pdf::loadView('pdf.maintenances', compact('maintenances'));
        return $pdf->download('maintenances.pdf');
    });

    Route::get('/calendrier', function () {
        $maintenances = Maintenance::with('equipment')->get();
        return view('calendrier', compact('maintenances'));
    });

//interventions
    Route::get('/interventions', function () {

        $interventions = \App\Models\Intervention::latest()->get();

        $maintenances = \App\Models\Maintenance::all();

        return view('interventions', compact(
            'interventions',
            'maintenances'
        ));
    });

    Route::get('/listeint', function () {
        $interventions = \App\Models\Intervention::latest()->paginate(10);
        return view('listeint', compact('interventions'));
    });

    Route::post('/interventions', function(Request $request){
        \App\Models\Intervention::create([
            'maintenance_id' => $request->maintenance_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'rapport' => $request->rapport,

        ]);
        return back()->with('success', 'Intervention ajoutée');
    });

//rapport
Route::get('/rapport', function () {

    $totalEquipments = \App\Models\Equipment::count();

    $totalMaintenances = \App\Models\Maintenance::count();

    $totalInterventions = \App\Models\Intervention::count();

    $terminees = \App\Models\Maintenance::where('status','termine')->count();

    $encours = \App\Models\Maintenance::where('status','en cours')->count();

    $attente = \App\Models\Maintenance::where('status','en attente')->count();

    return view('rapport', compact(
        'totalEquipments',
        'totalMaintenances',
        'totalInterventions',
        'terminees',
        'encours',
        'attente'
    ));
});

//parametre
Route::get('/parametres', function () {
    return view('parametres');
});


//pdf rapport
Route::get('/export-pdf', function () {

    $equipments = \App\Models\Equipment::all();

    $maintenances = \App\Models\Maintenance::with('equipment')->get();

    $interventions = \App\Models\Intervention::all();

    $totalEquipments = \App\Models\Equipment::count();

    $totalMaintenances = \App\Models\Maintenance::count();

    $totalInterventions = \App\Models\Intervention::count();

    $terminees = \App\Models\Maintenance::where('status','termine')->count();

    $encours = \App\Models\Maintenance::where('status','en cours')->count();

    $attente = \App\Models\Maintenance::where('status','en attente')->count();

    $pdf = Pdf::loadView('pdf.rapport', compact(
        'equipments',
        'maintenances',
        'interventions',
        'totalEquipments',
        'totalMaintenances',
        'totalInterventions',
        'terminees',
        'encours',
        'attente'
    ));

    return $pdf->download('Rapport_OCP.pdf');
});



});

