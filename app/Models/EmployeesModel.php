<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesModel extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'Name',
        'Email',
        'Phone',
        'Location',
    ];

}
