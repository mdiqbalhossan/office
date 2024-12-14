<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeExtraDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'type',
        'name',
        'amount',
        'amount_type',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
