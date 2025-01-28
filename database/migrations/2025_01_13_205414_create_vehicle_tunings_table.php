<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_tunings', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('vehicle_id')->constrained('vehicles')->onDelete('cascade'); // Foreign key to vehicles
            $table->foreignId('tuning_id')->constrained('tunings')->onDelete('cascade'); // Foreign key to tunings
            $table->integer('difference_power'); // Difference in power
            $table->integer('difference_torque'); // Difference in torque
            $table->integer('max_power')->nullable();; // Maximum power
            $table->integer('max_torque')->nullable(); // Maximum torque
            $table->text('power_chart')->nullable(); // Power chart as text, nullable
            $table->text('torque_chart')->nullable(); // Torque chart as text, nullable
            $table->string('tuning_stage'); // Tuning stage
            $table->timestamps(); // created_at and updated_at
            $table->decimal('price', 10, 2)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_tunings');
    }
};
