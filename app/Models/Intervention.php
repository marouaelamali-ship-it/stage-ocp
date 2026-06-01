<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $fillable = [
        'maintenance_id',
        'technicien',
        'date_intervention',
        'etat'
    ];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
