<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareDetailsModel extends Model
{
    use HasFactory;

    protected $table = 'schedule_interview';
  protected $fillable = [
    'ApplicantId',
    'EmployerId',
    'CreatedBy',
    'CreatedOn',
    'UpdatedBy',
    'UpdatedOn',
    'Status'
  ];
}
