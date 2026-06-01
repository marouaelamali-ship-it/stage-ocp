<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [

        'equipment_id',
        'type',
        'description',
        'status',

    ];

    public function equipment()
    {
        return $this->belongsTo(\App\Models\Equipment::class);
    }

    public function interventions()
    {
        return $this->hasMany(Intervention::class);
    }

}
