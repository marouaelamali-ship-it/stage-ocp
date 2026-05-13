<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'equipment_id',
        'type',
        'description',
        'status'
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}