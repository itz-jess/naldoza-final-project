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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();                   // Primary key
            $table->string('name');         // Employee name
            $table->string('email')->unique(); // Employee email, must be unique
            $table->string('position');     // Job position
            $table->decimal('salary', 10, 2); // Salary with 2 decimals
            $table->timestamps();           // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};