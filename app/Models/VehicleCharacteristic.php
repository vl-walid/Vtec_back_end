<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCharacteristic extends Model
{
    use HasFactory;
    protected $fillable = [
        'vehicle_id',      // Add vehicle_id to the fillable array
        'vehicle_tuning_id', // You might need this as well
        'characteristic_id', // Add characteristic_id if needed
    ];
}
