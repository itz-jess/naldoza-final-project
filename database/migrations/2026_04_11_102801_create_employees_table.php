<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('position');
            $table->text('skills')->nullable();
            $table->string('department')->default('IT');
            $table->string('rank')->nullable();
            $table->decimal('salary', 10, 2);
            $table->integer('leave_credits')->default(15);
            $table->date('hire_date')->nullable();
            $table->boolean('is_active')->default(false);
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('approved_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};