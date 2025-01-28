<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsTable extends Migration
{
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId(column: 'brand_id')->constrained('brands')->onDelete('cascade'); // Foreign key referencing brands table
            $table->string('slug')->nullable(); // Slug field, nullable
            $table->string('name'); // Name field
            $table->timestamps(); // created_at and updated_at timestamps
            $table->boolean('is_active')->default(true); // Add is_active column with a default value of true

        });
    }

    public function down()
    {
        Schema::dropIfExists('models'); // Drops the models table if it exists
    }
}
