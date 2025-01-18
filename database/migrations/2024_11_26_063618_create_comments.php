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
        Schema::create('comments', function (Blueprint $table) {
            $table->string('uuid');
            $table->string('uuidcomment');
            $table->string('author');
            $table->string('postauthor');
            $table->string('profile_author');
            $table->string('title')->nullable();
            $table->string('comment');
            $table->string('solving')->nullable();
            $table->string('comment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
