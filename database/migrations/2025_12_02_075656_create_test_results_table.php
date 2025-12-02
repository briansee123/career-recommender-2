<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('mbti_type', 4); // e.g., INTJ, ENFP
            $table->text('recommended_careers');
            $table->text('skills')->nullable();
            $table->text('interests')->nullable();
            $table->string('academic_background')->nullable();
            $table->json('answers')->nullable(); // Store all answers
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};