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
        Schema::create('employee_company_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('designation_id')->constrained()->cascadeOnDelete();
            $table->enum('salary_type', ['fixed', 'hourly'])->default('fixed');
            $table->decimal('basic_salary', 10, 2)->default(0);
            $table->decimal('hourly_rate', 10, 2)->default(0);
            $table->decimal('full_day_absence_fine', 10, 2)->default(0);
            $table->decimal('half_day_absence_fine', 10, 2)->default(0);
            $table->decimal('late_attendance_fine', 10, 2)->default(0);
            $table->integer('yearly_leave_quota')->default(0);
            $table->integer('monthly_leave_quota')->default(0);
            $table->date('joining_date');
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_company_details');
    }
};
