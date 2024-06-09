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
        Schema::create('member_quiz', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_id')->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('quiz_id')->references('id')->on('quizzes')->onUpdate('cascade')->onDelete('cascade');

            $table->string('token')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_quiz');
    }
};
