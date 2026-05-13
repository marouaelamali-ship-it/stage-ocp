<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    
    protected $table = 'equipments';
    protected $fillable = ['name', 'reference', 'category_id', 'location', 'status'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function maintenances(){
        return $this->hasMany(Maintenance::class);
    }

    

}
