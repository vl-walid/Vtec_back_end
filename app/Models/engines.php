<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class engines extends Model
{
    use HasFactory;

    protected $primaryKey = "engine_id";

    protected $fillable = [
        "engine_name"
    ];

}
