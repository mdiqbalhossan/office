<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'name', 'description', 'status'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
