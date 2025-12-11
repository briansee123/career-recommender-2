<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Personal Info
            $table->string('job_title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->default('Malaysia');
            $table->string('photo')->nullable();
            
            // Professional Summary
            $table->text('summary')->nullable();
            
            // Work Experience
            $table->string('experience_company')->nullable();
            $table->string('experience_title')->nullable();
            $table->string('experience_duration')->nullable();
            $table->text('experience_description')->nullable();
            
            // Education
            $table->string('education_institution')->nullable();
            $table->string('education_degree')->nullable();
            $table->string('education_year')->nullable();
            
            // Skills
            $table->text('skills')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};