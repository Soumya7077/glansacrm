<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnboardModel extends Model
{
    use HasFactory;
    protected $table = 'onboard';
    protected $fillable = [
        'id',
        'ApplicantId',
        'JobId',
        'InterviewId',
        'EmployerId',
        'FolderPath',
        'Subject',
        'SalaryOffer',
        'JoiningDate',
        'Shift',
        'Benefits',
        'Remark',
        'CreatedBy',
        'CreatedOn',
        'Status',
        'UpdatedOn',
        'UpdatedBy',
    ];
}
