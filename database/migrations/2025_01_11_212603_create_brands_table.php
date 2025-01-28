<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{

    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing BIGINT UNSIGNED primary key
            $table->string('type'); // Column for brand type
            $table->foreignId(column: 'categories_id')->constrained('categories')->onDelete('cascade'); // Foreign key referencing brands table
            $table->string('slug')->nullable(); // Unique slug for the brand, nullable
            $table->string('name'); // Brand name
            $table->string('image')->nullable(); // Brand image (nullable)
            $table->timestamps(); // Columns for created_at and updated_at timestamps
            $table->boolean('is_active')->default(true); // Add is_active column with a default value of true

        });
    }

    public function down()
    {
        Schema::dropIfExists('brands'); // Drops the brands table if it exists
    }
}
