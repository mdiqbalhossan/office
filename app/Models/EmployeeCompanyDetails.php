<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeCompanyDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'department_id',
        'designation_id',
        'salary_type',
        'basic_salary',
        'hourly_rate',
        'full_day_absence_fine',
        'half_day_absence_fine',
        'late_attendance_fine',
        'yearly_leave_quota',
        'monthly_leave_quota',
        'joining_date',
        'end_date',
    ];

    protected $dates = [
        'joining_date',
        'end_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function getSalaryAttribute()
    {
        return $this->salary_type === 'fixed' ? $this->basic_salary : $this->hourly_rate;
    }
}
