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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Add auto-increment primary key
            $table->uuid('uuid')->unique(); // Assuming uuid is unique
            $table->string('title')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('author')->nullable(); // Foreign key for users table (author)
            $table->string('profile_author')->nullable();
	        $table->string('upload_date')->nullable();
	        $table->string('typepost');
            $table->string('answer')->default('unsolved');
            // Foreign key constraint: author_id references users.id
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
