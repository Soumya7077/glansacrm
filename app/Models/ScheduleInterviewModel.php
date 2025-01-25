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
    'id',
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
// ScheduleInterviewModel.php

public function employee()
{
    return $this->belongsTo(EmployeesModel::class, 'employerId'); // 'employeeId' is the foreign key
}

public function applicant()
{
    return $this->belongsTo(ApplicantModel::class, 'applicantId'); // 'applicantId' is the foreign key
}

public function job()
{
    return $this->belongsTo(JobPostModel::class, 'jobId'); // 'jobId' is the foreign key
}

}
