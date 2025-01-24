<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Product Images Table
    // This table has many-to-one relationship with the product colours table
    // One product colour can have multiple images
    public function up(): void
    {
        Schema::create('product_images', function(Blueprint $table) {
            $table->id(); //Primary key
            $table->foreignId('product_color_id')->nullable()->onDelete('cascade'); //Foreign Key linking to the product colour that the image belongs to
            $table->string('Image Url'); //Image url
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
