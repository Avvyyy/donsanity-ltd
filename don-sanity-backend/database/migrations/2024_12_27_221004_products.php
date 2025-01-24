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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('category_id')->nullable()->onDelete('cascade'); //Foreign key referring to the category that the product belongs to
            $table->string('name'); // Product name
            $table->string('slug')->unique(); // Unique slug
            $table->text('description')->nullable(); // Description (optional)
            $table->integer('price'); // Price
            $table->boolean('viewable')->default(true); // Viewable status
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
