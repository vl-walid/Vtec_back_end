<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'generations';

    // Define the fillable attributes
    protected $fillable = [
        'model_id',
        'name',
        'is_active',
    ];

    // Define the relationship to the Brand model (ensure you have this model created)
    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id'); // Adjust the path if your Brand model is in a different namespace
    }
    public function engines()
    {
        return $this->hasMany(Engine::class, 'generations_id');
    }
    use HasFactory;
}
