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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('achievement_type'); // e.g., "Pages Read"
            $table->integer('goal'); // e.g., "100 pages"
            $table->integer('progress'); // e.g., "50 pages read"
            $table->integer('trazan'); // e.g., "50 pages read"
            
            
            $table->boolean('achieved')->default(false); // Whether the user has completed the achievement


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
