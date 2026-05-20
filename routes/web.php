<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Maintenance;

use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\AuthController;

use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return redirect('/login');

});

/*
|--------------------------------------------------------------------------
| LOGIN PAGE
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {

    return view('auth.login');

})->name('login');

/*
|--------------------------------------------------------------------------
| LOGIN ACTION
|--------------------------------------------------------------------------
*/

Route::post('/login', function (Request $request) {

    $credentials = $request->validate([

        'email' => ['required', 'email'],
        'password' => ['required'],

    ]);

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        return redirect('/dashboard');

    }

    return back()->withErrors([
        'email' => 'Email ou mot de passe incorrect',
    ]);

});

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

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

        $maintenances = Maintenance::latest()->paginate(5);

        $totalMaintenances = Maintenance::count();

        $termines = Maintenance::where('status', 'Terminée')->count();

        $encours = Maintenance::where('status', 'En cours')->count();

        $critiques = Maintenance::where('status', 'Critique')->count();

        return view('dashboard', compact(
            'maintenances',
            'totalMaintenances',
            'termines',
            'encours',
            'critiques'
        ));

    });

});

    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF
    |--------------------------------------------------------------------------
    */

    Route::get('/export-pdf', function () {

        $maintenances = Maintenance::all();

        $pdf = Pdf::loadView('pdf.maintenances', compact('maintenances'));

        return $pdf->download('maintenances.pdf');

    });

    /*
    |--------------------------------------------------------------------------
    | PAGE AJOUT MAINTENANCE
    |--------------------------------------------------------------------------
    */

    Route::get('/maintenances', function () {

        return view('maintenance');

    });

    /*
    |--------------------------------------------------------------------------
    | AJOUTER MAINTENANCE
    |--------------------------------------------------------------------------
    */

    Route::post('/maintenances', function (Request $request) {

        Maintenance::create([

            'equipment_id' => 1,
            'type' => 'corrective',
            'description' => $request->equipment,
            'status' => $request->status,

        ]);

        return redirect('/dashboard')->with('success', 'Maintenance ajoutée');

    });

    /*
    |--------------------------------------------------------------------------
    | DELETE MAINTENANCE
    |--------------------------------------------------------------------------
    */

    Route::delete('/maintenances/{id}', function ($id) {

        Maintenance::findOrFail($id)->delete();

        return redirect('/dashboard')->with('delete', 'Maintenance supprimée');

    });

    /*
    |--------------------------------------------------------------------------
    | PAGE EDIT
    |--------------------------------------------------------------------------
    */

    Route::get('/maintenances/{id}/edit', function ($id) {

        $maintenance = Maintenance::findOrFail($id);

        return view('edit-maintenance', compact('maintenance'));

    });

    /*
    |--------------------------------------------------------------------------
    | UPDATE MAINTENANCE
    |--------------------------------------------------------------------------
    */

    Route::put('/maintenances/{id}', function (Request $request, $id) {

        $maintenance = Maintenance::findOrFail($id);

        $maintenance->update([

            'status' => $request->status,

        ]);

        return redirect('/dashboard')->with('success', 'Maintenance mise à jour');

    });


Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/equipments', [EquipmentController::class, 'index']);
    Route::post('/equipments', [EquipmentController::class, 'store']);

});