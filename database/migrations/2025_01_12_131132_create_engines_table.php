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
        Schema::create('engines', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('generation_id'); // Foreign key for brand
            $table->string('name'); // Name column
            $table->timestamps(); // Created at and updated at timestamps
            $table->boolean('is_active')->default(true); // Add is_active column with a default value of true
            $table->foreign('generation_id')->references('id')->on('generations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('engines');
    }
};
