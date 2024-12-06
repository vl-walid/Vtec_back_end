<?php
namespace App\Models;

use App\Models\models;

class tuning extends models {

    protected $primaryKey = "tuning_id";

    protected $fillable = [
        "tuning_name"
    ];

    protected $table = "tuning";

};