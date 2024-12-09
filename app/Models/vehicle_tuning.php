<?php
namespace App\Models;

use App\Models\models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class vehicle_tuning extends models {

    use HasFactory;

    protected $primaryKey = "vehicle_tuning_id";

    protected $fillable = [
        "vehicle_tuning_power_chart",
        "vehicle_tuning_torque_chart",
        "vehicle_tuning_max_power",
        "vehicle_tuning_max_torque",
        "vehicle_tuning_difference_torque",
        "vehicle_tuning_difference_power",
    ];

    protected $table = "vehicle_tuning";

};