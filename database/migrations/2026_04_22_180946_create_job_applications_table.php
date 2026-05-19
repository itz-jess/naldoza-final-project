<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_position_id')->constrained('job_positions');
            $table->string('applicant_name');
            $table->string('email');
            $table->string('contact_number');
            $table->text('address');
            $table->text('skills');
            $table->text('experience')->nullable();
            $table->enum('status', ['pending', 'shortlisted', 'interviewed', 'hired', 'rejected'])->default('pending');
            $table->timestamp('rejected_at')->nullable(); // For archive tracking
            $table->timestamps();
            $table->softDeletes(); // For archive (soft delete)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};