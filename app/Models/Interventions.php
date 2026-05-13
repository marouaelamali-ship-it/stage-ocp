<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interventions extends Model
{
    protected $fillable = ['maintenance_id', 'user_id', 'description', 'date_debut', 'date_fin', 'rapport'];

    public function maintenance(){
        return $this->belongsTo(Maintenance::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
