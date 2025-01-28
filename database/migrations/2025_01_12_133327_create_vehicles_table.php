<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('engine_id')->constrained('engines')->onDelete('cascade'); // Foreign key referencing engines table
            $table->string('full_name'); // Full name of the vehicle
            $table->float('standard_power'); // Standard power
            $table->float('standard_torque'); // Standard torque
            $table->string('fuel'); // Fuel type
            $table->string('ecu'); // ECU
            $table->text('rpm'); // RPM (text type)
            $table->text('oem_power_chart'); // OEM power chart (text type)
            $table->text('oem_torque_chart'); // OEM torque chart (text type)
            $table->timestamps(); // created_at and updated_at timestamps
            $table->boolean('is_active')->default(true); // Add is_active column with a default value of true

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
