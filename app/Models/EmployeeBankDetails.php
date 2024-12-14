<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBankDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'bank_name',
        'branch_name',
        'account_name',
        'account_number',
        'iban',
        'swift_code',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
