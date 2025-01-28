<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); 
            $table->string('category_name'); // Column for category names
            $table->timestamps(); // Columns for created_at and updated_at timestamps
            $table->boolean('is_active')->default(true); // Add is_active column with a default value of true

        });
    }

    public function down()
    {
        Schema::dropIfExists('categories'); // Drops the categories table if it exists
    }
}
