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
        Schema::dropIfExists('vehicles_characteristics');
        Schema::create('vehicles_characteristics', function (Blueprint $table) {
            $table->id("vehicle_characteristic_id");
            $table->string("vehicle_characteristic_name");
            $table->boolean("vehicle_characteristic_active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles_characteristics');
    }
};
