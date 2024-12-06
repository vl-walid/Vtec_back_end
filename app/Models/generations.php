<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class generations extends Model
{
    use HasFactory;

    protected $primaryKey = "generation_id";

    protected $fillable = [
        "generation_name"
    ];

}
