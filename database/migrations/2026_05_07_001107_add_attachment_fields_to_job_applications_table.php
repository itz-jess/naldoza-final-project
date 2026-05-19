<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->integer('age')->nullable()->after('email');
            $table->enum('sex', ['male', 'female', 'other'])->nullable()->after('age');
            $table->string('resume_file')->nullable()->after('experience');
            $table->string('profile_picture')->nullable()->after('resume_file');
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropColumn(['age', 'sex', 'resume_file', 'profile_picture']);
        });
    }
};