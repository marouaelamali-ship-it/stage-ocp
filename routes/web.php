<?php

use Illuminate\Support\Facades\Route;
use App\Models\Maintenance;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect('/login');
});

/*
|--------------------------------------------------------------------------
| LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', function () {
    return redirect('/dashboard');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $maintenances = Maintenance::latest()->get();

    return view('dashboard', compact('maintenances'));

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

        'equipment' => $request->equipment,
        'technicien' => $request->technician,
        'date' => $request->date,
        'status' => $request->status,

    ]);

    return redirect('/dashboard');

});

/*
|--------------------------------------------------------------------------
| SUPPRIMER
|--------------------------------------------------------------------------
*/

Route::delete('/maintenances/{id}', function ($id) {

    Maintenance::findOrFail($id)->delete();

    return redirect('/dashboard');

});

/*
|--------------------------------------------------------------------------
| EDIT PAGE
|--------------------------------------------------------------------------
*/

Route::get('/maintenances/{id}/edit', function ($id) {

    $maintenance = Maintenance::findOrFail($id);

    return view('edit-maintenance', compact('maintenance'));

});

/*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/

Route::put('/maintenances/{id}', function (Request $request, $id) {

    $maintenance = Maintenance::findOrFail($id);

    $maintenance->update([

        'equipment' => $request->equipment,
        'technicien' => $request->technician,
        'date' => $request->date,
        'status' => $request->status,

    ]);

    return redirect('/dashboard');

});