<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    // Fields that are mass assignable
    protected $fillable = ['category_name' ,'is_active',];

    // Define the relationship with brands
    public function brands()
    {
        return $this->hasMany(Brand::class, 'categories_id');
    }
    
}
