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
            
            $table->id(); // Primary key
            $table->string('name'); // Name field
            $table->string('image')->nullable(); // Name field
            $table->string('email')->unique(); // Unique email field
            $table->string('password'); // Password field
            $table->integer('age')->default(0);; // Changed to integer for age
            $table->string('level')->default(0); // Assuming this is a string (like beginner, intermediate, advanced)
            $table->integer('golden_letter_wins')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

       

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');

    }
};
