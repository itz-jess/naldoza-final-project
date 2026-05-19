<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_seminar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees', 'id')->onDelete('cascade');
            $table->foreignId('seminar_id')->constrained('seminars')->onDelete('cascade');
            $table->date('attended_date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_seminar');
    }
};