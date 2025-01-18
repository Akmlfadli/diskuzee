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
        Schema::create('reply', function (Blueprint $table) {
            $table->string('uuid');
            $table->string('uuidcomment');
            $table->string('uuidreply');
            $table->string('author');
            $table->string('profile_author');
            $table->string('comment');
            $table->string('solving')->nullable();
            $table->string('reply_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply');
    }
};
