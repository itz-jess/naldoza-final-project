<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->foreignId('created_employee_id')->nullable()->after('status')
                  ->constrained('employees')->nullOnDelete();
            $table->timestamp('converted_to_employee_at')->nullable()->after('rejected_at');
        });
    }

    public function down(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->dropForeign(['created_employee_id']);
            $table->dropColumn(['created_employee_id', 'converted_to_employee_at']);
        });
    }
};