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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->string('type');
            $table->boolean('is_audio');
            $table->string('ai_expected_time');
            $table->string('language');
            $table->string('rating');
            $table->boolean('is_for_family');
            $table->boolean('has_series');
            $table->text('summary');
            $table->boolean('is_purchased');
            $table->string('photo_id');
            $table->boolean('is_free');
            $table->boolean('is_free_sample');
            $table->integer('discount_rate');
            $table->boolean('is_like');
            $table->boolean('is_dislike');
            $table->integer('number_of_pages');
            $table->string('author');
            $table->integer('number_of_series');
            
            // Single user_id foreign key
            $table->unsignedBigInteger('user_id'); // Foreign key for the user who can be Writer, Reader, or Poster
            
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
