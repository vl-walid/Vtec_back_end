<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ecus_brands extends Model
{
    use HasFactory;

    protected $primaryKey = "ecu_brand_id";

    protected $fillable = [
        "ecu_brand_name"
    ];

}
