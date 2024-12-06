<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class vehicles_characteristics extends Model
{
    use HasFactory;

    protected $primaryKey = "vehicle_characteristic_id";

    protected $fillable = [
        "vehicle_characteristic_vehicle",
        "vehicle_characteristic_characteristic"
    ];

    protected $table = "vehicle_characteristics";

    public function vehicle(): BelongsTo {
        return $this->belongsTo(vehicles::class, "vehicle_characteristic_vehicle");
    }

    public function characteristics(): BelongsTo {
        return $this->belongsTo(characteristics::class, "vehicle_characteristic_characteristic");
    }

}
