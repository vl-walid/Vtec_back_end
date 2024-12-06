<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle_data_chart extends Model
{
    use HasFactory;

    protected $primaryKey = "vehicle_data_id";

    protected $fillable = [
        "vehicle_data_rpm",
        "vehicle_data_oem_power_chart",
        "vehicle_data_oem_torque_chart",
    ];
}
