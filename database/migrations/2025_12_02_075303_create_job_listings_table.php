<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company');
            $table->string('company_icon')->default('C');
            $table->string('location');
            $table->string('salary')->nullable();
            $table->text('description')->nullable();
            $table->enum('job_type', ['full-time', 'part-time', 'contract', 'internship'])->default('full-time');
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
            $table->boolean('is_available')->default(true);
            $table->date('posted_date')->nullable();
            $table->json('required_skills')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};