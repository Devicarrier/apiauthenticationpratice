<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_id',
        'name',
        'email',
        'phone',
        'dob',
        'address',
        'destination',
        'date_of_join',
        'status',
    ];
}
