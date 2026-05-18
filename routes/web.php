<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Maintenance;

use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\AuthController;

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

Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');

});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $maintenances = Maintenance::latest()->paginate(5);

    $totalMaintenances = Maintenance::count();

    $termines = Maintenance::where('status', 'termine')->count();

    $encours = Maintenance::where('status', 'en cours')->count();

    $critiques = Maintenance::where('status', 'en attente')->count();

    return view('dashboard', compact(
        'maintenances',
        'totalMaintenances',
        'termines',
        'encours',
        'critiques'
    ));

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

    return redirect('/dashboard');

});

/*
|--------------------------------------------------------------------------
| DELETE MAINTENANCE
|--------------------------------------------------------------------------
*/

Route::delete('/maintenances/{id}', function ($id) {

    Maintenance::findOrFail($id)->delete();

    return redirect('/dashboard');

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

        'technicien' => $request->technician,
        'date' => $request->date,
        'status' => $request->status,

    ]);

    return redirect('/dashboard');

});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/equipments', [EquipmentController::class, 'index']);
    Route::post('/equipments', [EquipmentController::class, 'store']);

});