<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vehicles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'engine_id',
        'full_name',
        'standard_power',
        'standard_torque',
        'fuel',
        'ecu',
        'rpm',
        'oem_power_chart',
        'oem_torque_chart',
        'is_active',
    ];

    public function engine()
    {
        return $this->belongsTo(Engine::class);
    }

    public function vehicletunings()
    {
        return $this->hasMany(VehicleTuning::class, 'vehicle_id');
    }
}
