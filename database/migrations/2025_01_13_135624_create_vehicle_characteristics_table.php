<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_characteristics', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->integer('vehicle_id');
            $table->integer('vehicle_tuning_id')->nullable();
            $table->integer('characteristic_id');
            $table->timestamps(); // created_at and updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_characteristics');
    }
}
