<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engine extends Model
{
    use HasFactory;

    protected $fillable = [
        'generation_id', 'name', 'is_active', 
    ];

    // Define the relationship with categories
    public function generation()
    {
        return $this->belongsTo(Category::class, 'generation_id');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
