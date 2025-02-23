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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('loan_id')->unique();
            $table->foreignId('loan_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->date('application_date');
            $table->decimal('amount', 10, 2); 
            $table->decimal('monthly_installment', 10, 2)->nullable();
            $table->date('loan_issue_date')->nullable();
            $table->date('loan_expiry_date')->nullable();
            $table->mediumText('reason')->nullable();
            $table->mediumText('remarks')->nullable();
            $table->mediumText('description')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->float('penalty_rate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
