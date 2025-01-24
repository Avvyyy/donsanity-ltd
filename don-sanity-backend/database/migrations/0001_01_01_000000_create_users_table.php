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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Full name of the user
            $table->string('email')->unique(); // User's email (unique for authentication)
            $table->string('password'); // Hashed password
            $table->string('phone')->nullable(); // Optional phone number
            $table->string('address')->nullable(); // Optional address
            $table->boolean('is_admin')->default(false); // Determines if the user is an admin
            $table->string('avatar')->nullable(); // Profile picture URL
            $table->json('preferences')->nullable(); // JSON to store user-specific preferences (e.g., favorite categories)
            $table->rememberToken(); // Token for "Remember Me" functionality
            $table->timestamps(); // created_at and updated_at columns
        });
        

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
