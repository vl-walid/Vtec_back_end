<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class models extends Model
{
    use HasFactory;

    protected $primaryKey = "model_id";

    protected $fillable = [
        "model_name"
    ];

}
