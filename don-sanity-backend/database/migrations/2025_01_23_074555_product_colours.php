<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Products Colour Table
    // This is table has a many-to-one relationship with the products table
    // One product can have many colours
    public function up(): void
    {
        Schema::create('product_colours', function(Blueprint $table){
            $table->id(); //Primary ket
            $table->foreignId('product_id')->nullable()->onDelete('cascade'); //Foreign key linking to the product that the colour belongs to
            $table->string('Colour Name'); //Colour name;

            //Implement a future to autogenerate the hex colour code depending on the image uploaded
            $table->string('Colour Code'); //Hex colour code for the colour
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_colours');
    }
};
