<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id('performance_id');
            $table->foreignId('employee_id')->constrained('employees', 'id')->onDelete('cascade');
            $table->date('review_date');
            $table->integer('rating')->between(1, 5);
            $table->text('comments')->nullable();
            $table->text('strengths')->nullable();
            $table->text('areas_for_improvement')->nullable();
            $table->foreignId('reviewed_by')->constrained('users', 'id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performances');
    }
};