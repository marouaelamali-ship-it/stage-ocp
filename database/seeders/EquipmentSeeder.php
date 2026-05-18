<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Equipment;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::create([
            'name' => 'General'
        ]);

        Equipment::create([
            'name' => 'Machine 1',
            'reference' => 'EQ-001',
            'category_id' => $category->id,
            'location' => 'Warehouse A'
        ]);
    }
}