<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuning extends Model
{
    use HasFactory;


    // Specify the table associated with the model
    protected $table = 'tunings';

    protected $fillable = ['name'];

}
