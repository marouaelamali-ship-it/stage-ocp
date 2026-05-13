<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        return Equipment::with('category')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'reference' => 'required',
            'category_id' => 'required',
            'location' => 'required',
            'status' => 'required'
        ]);

        $equipment = Equipment::create($validated);

        return response()->json([
            'message' => 'Equipment created successfully',
            'data' => $equipment
        ], 201);
    }

    public function show(string $id)
    {
        return Equipment::with('category')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $equipment = Equipment::findOrFail($id);

        $equipment->update($request->all());

        return response()->json([
            'message' => 'Equipment updated successfully',
            'data' => $equipment
        ]);
    }

    public function destroy(string $id)
    {
        $equipment = Equipment::findOrFail($id);

        $equipment->delete();

        return response()->json([
            'message' => 'Equipment deleted successfully'
        ]);
    }
}