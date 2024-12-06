<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class characteristics extends Model
{
    use HasFactory;

    protected $primaryKey = "characteristic_id";

    protected $fillable = [
        "characteristic_name"
    ];

    protected $table = "characteristics";

};