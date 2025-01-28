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
        Schema::create('generations', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('model_id')->constrained('models')->onDelete('cascade'); // Foreign key referencing models table
            $table->string('name'); // Name column
            $table->timestamps(); // Created at and updated at timestamps
            $table->boolean('is_active')->default(true); // Add is_active column with a default value of true

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generations');
    }
};
