<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Maintenance;
use App\Http\Controllers\MaitenanceController;

use App\Models\Equipment;
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

        /* Route::get('/dashboard', function () {

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
            */
            
            Route::get('/dashboard', function () {

                $maintenances = \App\Models\Maintenance::latest()->paginate(5);

                $totalMaintenances = \App\Models\Maintenance::count();

                $termines = \App\Models\Maintenance::where(
                    'status',
                    'Terminée'
                )->count();

                $encours = \App\Models\Maintenance::where(
                    'status',
                    'En cours'
                )->count();

                $critiques = \App\Models\Maintenance::where(
                    'status',
                    'Critique'
                )->count();

                $equipments = \App\Models\Equipment::count();

                $users = \App\Models\User::count();

                return view('dashboard', compact(
                    'maintenances',
                    'totalMaintenances',
                    'termines',
                    'encours',
                    'critiques',
                    'equipments',
                    'users'
                ));

            })->middleware('auth');

        


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

        $equipments = \App\Models\Equipment::all();

        return view('maintenance', compact('equipments'));

    });

    /*
    |--------------------------------------------------------------------------
    | AJOUTER MAINTENANCE
    |--------------------------------------------------------------------------
    */

    Route::post('/maintenances', function (Request $request) {

        if(auth()->user()->role != 'admin') abort(403);

        Maintenance::create([

            'equipment_id' => $request->equipment_id,
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

        if(auth()->user()->role != 'admin') abort(403);

        Maintenance::findOrFail($id)->delete();

        return redirect('/dashboard')->with('delete', 'Maintenance supprimée');

    });

    /*
    |--------------------------------------------------------------------------
    | PAGE EDIT
    |--------------------------------------------------------------------------
    */

    Route::get('/maintenances/{id}/edit', function ($id) {

        if(auth()->user()->role != 'admin') abort(403);

        $maintenance = Maintenance::findOrFail($id);

        return view('edit-maintenance', compact('maintenance'));

    });

    /*
    |--------------------------------------------------------------------------
    | UPDATE MAINTENANCE
    |--------------------------------------------------------------------------
    */

    Route::put('/maintenances/{id}', function (Request $request, $id) {

        if(auth()->user()->role != 'admin') abort(403);

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

    Route::get('/search-maintenances', function (Request $request) {

        $search = $request->search;

        $maintenances = \App\Models\Maintenance::where(
            'status',
            'LIKE',
            "%$search%"
        )->get();

        return response()->json($maintenances);

    });
});

/*
|--------------------------------------------------------------------------
| EQUIPMENTS PAGE
|--------------------------------------------------------------------------
*/

Route::get('/equipments', function () {

    $equipments = Equipment::latest()->get();

    return view('equipments', compact('equipments'));

});

/*
|--------------------------------------------------------------------------
| ADD EQUIPMENT
|--------------------------------------------------------------------------
*/

Route::post('/equipments', function (Request $request) {

    if(auth()->user()->role != 'admin') abort(403);

    Equipment::create([

        'name' => $request->name,
        'serial_number' => $request->serial_number,
        'status' => $request->status,

    ]);

    return back()->with('success', 'Équipement ajouté');

});

/*
|--------------------------------------------------------------------------
| DELETE EQUIPMENT
|--------------------------------------------------------------------------
*/

Route::delete('/equipments/{id}', function ($id) {

    if(auth()->user()->role != 'admin') abort(403);

    Equipment::findOrFail($id)->delete();

    return back()->with('delete', 'Équipement supprimé');

});

Route::get('/equipments', function () {

    return view('equipments');

});

/*
|--------------------------------------------------------------------------
| EQUIPMENTS
|--------------------------------------------------------------------------
*/

Route::get('/equipments', function () {

    $equipments = Equipment::latest()->paginate(5);

    $totalEquipments = Equipment::count();

    $disponibles = Equipment::where('status', 'Disponible')->count();

    $maintenance = Equipment::where('status', 'Maintenance')->count();

    $critiques = Equipment::where('status', 'Critique')->count();

    return view('equipments', compact(
        'equipments',
        'totalEquipments',
        'disponibles',
        'maintenance',
        'critiques'
    ));

});

Route::post('/equipments', function (Request $request) {

    if(auth()->user()->role != 'admin') abort(403);

    Equipment::Route::post('/equipments', function (Request $request) {

    $imageName = null;

    if($request->hasFile('image')) {

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(
            public_path('uploads'),
            $imageName
        );

    }

    \App\Models\Equipment::create([

        'name' => $request->name,
        'reference' => $request->reference,
        'status' => $request->status,
        'image' => $imageName,

    ]);

    return back()->with('success', 'Equipement ajouté');

});
});


Route::delete('/equipments/{id}', function ($id) {

    if(auth()->user()->role != 'admin') abort(403);

    Equipment::findOrFail($id)->delete();

    return redirect('/equipments')
        ->with('delete', 'Équipement supprimé');

});

Route::get('/equipments/{id}/edit', function ($id) {

    $equipment = Equipment::findOrFail($id);

    return view('edit-equipment', compact('equipment'));

});

Route::put('/equipments/{id}', function (Request $request, $id) {

    if(auth()->user()->role != 'admin') abort(403);

    $equipment = Equipment::findOrFail($id);

    $equipment->update([

        'name' => $request->name,
        'type' => $request->type,
        'status' => $request->status,

    ]);

    return redirect('/equipments')
        ->with('update', 'Équipement modifié');

});

});
