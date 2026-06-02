<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $fillable = [
        'maintenance_id',
        'date_debut',
        'date_fin',
        'rapport'
    ];
    
    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
}
