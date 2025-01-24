<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleInterviewModel extends Model
{
  use HasFactory;

  protected $table = 'schedule_interview';

  // Disable automatic timestamps
  public $timestamps = false;
  protected $fillable = [
    'EmployerId',
    'ApplicantId',
    'JobId',
    'Type',
    'Link/Location',
    'InterviewDate',
    'BCC',
    'CC',
    'Description',
    'FirstTimeSlot',
    'SecondTimeSlot',
    'ThirdTimeSlot',
    'CreatedOn',
    'CreatedBy',
    'UpdatedBy',
    'UpdatedOn',
    'Status'
  ];

}
