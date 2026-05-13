<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();

        $table->foreignId('equipment_id')
        ->constrained('equipments')
        ->onDelete('cascade');

            $table->enum('type', [
                'corrective',
                'preventive'
            ]);

            $table->text('description');

            $table->enum('status', [
                'en attente',
                'en cours',
                'termine'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
