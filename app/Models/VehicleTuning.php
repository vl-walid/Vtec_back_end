<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleTuning extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'tuning_id',
        'difference_power',
        'difference_torque',
        'max_power',
        'max_torque',
        'power_chart',
        'torque_chart',
        'tuning_stage',
        'price',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
