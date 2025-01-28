<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'categories_id', 'slug', 'name', 'image' ,'is_active',  ];

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
    

    public function models()
    {
        return $this->hasMany(VehicleModel::class, 'brands_id');  // Custom foreign key
    }
}
