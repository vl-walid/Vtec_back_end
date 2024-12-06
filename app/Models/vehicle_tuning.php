<?php
namespace App\Models;

use App\Models\models;

class vehicle_tuning extends models {

    protected $primaryKey = "vehicle_tuning_id";

    protected $fillable = [
        "vehicle_tuning_power_chart",
        "vehicle_tuning_torque_chart",
        "vehicle_tuning_max_power",
        "vehicle_tuning_max_torque",
        "vehicle_tuning_difference_torque",
        "vehicle_tuning_difference_torque",
    ];

    protected $table = "vehicle_tuning";

};