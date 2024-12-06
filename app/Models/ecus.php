<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ecus extends Model
{
    use HasFactory;

    protected $primaryKey = "ecu_id";
    protected $table = "ecus";
    protected $fillable = [
        "ecu_name"
    ];

    public function ecu_brands():BelongsTo {
        return $this->belongsTo(ecus_brands::class);
    }

}
