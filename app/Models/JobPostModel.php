<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostModel extends Model
{
    use HasFactory;
    protected $table = 'job_post';
    protected $fillable = [
        'EmployerId',
        'Title',
        'Description',
        'CreatedOn',
        'CreatedBy',
        'ModifyOn',
        'ModifyBy',
        'Opening',
        'Salary',
        'Location',
        'Education',
        'KeySkills',
        'Department',
        'Experience',
        'Shift',
    ];
    // Disable default timestamps (created_at, updated_at)
    public $timestamps = false;

    // Use custom timestamp fields
    const CREATED_AT = 'CreatedOn';
    const UPDATED_AT = 'ModifyOn';

}
