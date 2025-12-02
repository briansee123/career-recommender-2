<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('age')->nullable()->after('phone');
            $table->string('nationality')->nullable()->after('age');
            $table->string('avatar')->default('😊')->after('nationality');
            $table->boolean('is_admin')->default(false)->after('avatar');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->after('is_admin');
            $table->text('resume_path')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'age', 'nationality', 'avatar', 'is_admin', 'status', 'resume_path']);
        });
    }
};