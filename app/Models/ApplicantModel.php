<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantModel extends Model
{
    use HasFactory;
    protected $table = 'applicant';
    protected $fillable = [
        'jobpost_id',
        'Source',
        'Name',
        'Email',
        'PhoneNumber',
        'Experience',
        'CurrentSalary',
        'ExpectedSalary',
        'Qualification',
        'Resume',
        'KeySkills',
        'StatusId',
        'CreatedOn',
    ];
}
