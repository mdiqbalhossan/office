<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'loan_type_id',
        'employee_id',
        'application_date',
        'amount',
        'monthly_installment',
        'loan_issue_date',
        'loan_expiry_date',
        'reason',
        'remarks',
        'description',
        'status',
        'approved_by',
        'penalty_rate'
    ];

    /**
     * Scope a query to only include active loans.
     */

    public function scopeStatus($query, $status)
    {
        if ($status === 'all') {
            return $query;
        }
        return $query->where('status', $status);
    }

    /**
     * Relation with LoanType
     */

    public function loanType()
    {
        return $this->belongsTo(LoanType::class, 'loan_type_id', 'id');
    }

    /**
     * Relation with Employee
     */

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
