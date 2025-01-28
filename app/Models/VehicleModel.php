<?php

namespace App\Models; // Ensure this matches your directory structure

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model  // Class name should be unique and follow naming conventions
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'models';

    // Define the fillable attributes
    protected $fillable = [
        'brand_id',
        'slug',
        'name',
        'is_active',
    ];

    // Define the relationship to the Brand model (ensure you have this model created)
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands_id');
    }

    public function generations()
    {
        return $this->hasMany(Generation::class, 'models_id');
    }
}
