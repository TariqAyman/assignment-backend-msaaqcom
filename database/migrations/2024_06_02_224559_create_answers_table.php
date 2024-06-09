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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->references('id')->on('members')->onUpdate('cascade')->onDelete('cascade');
            $table->string('tenant_id');
            $table->foreignId('attempt_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('question');
            $table->foreignId('question_id')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('is_correct')->nullable();
            $table->json('chosen_answers');
            $table->json('correct_answers');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tenant_id')->references('id')->on('tenants')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
