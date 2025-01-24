<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    // Category table
    // This table has a one-to-many relationship with the products table
    // One category can have several products
    public function up(): void
    {
        Schema::create('categories', function(Blueprint $table) {
              $table->id(); //Primary Key
              $table->string('name'); //category name
              $table->string('description')->nullable(); //Table description
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
