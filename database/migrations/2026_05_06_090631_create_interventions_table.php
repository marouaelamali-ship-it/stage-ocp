<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interventions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('maintenance_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('technicien');

            $table->date('date_intervention');

            $table->enum('etat', [
                'planifiee',
                'en cours',
                'terminee'
            ]);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};