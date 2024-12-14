<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'first_name',
        'last_name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip',
        'country',
        'remarks',
        'photo',
    ];

    protected $dates = [
        'date_of_birth',
    ];

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getAgeAttribute()
    {
        return $this->date_of_birth->age;
    }

    public function companyDetails()
    {
        return $this->hasOne(EmployeeCompanyDetails::class);
    }

    public function bankDetails()
    {
        return $this->hasOne(EmployeeBankDetails::class);
    }

    public function extraDetails()
    {
        return $this->hasMany(EmployeeExtraDetails::class);
    }
}
