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
    'FirstName',
    'LastName',
    'Email',
    'PhoneNumber',
    'Experience',
    'CurrentSalary',
    'ExpectedSalary',
    'Qualification',
    'Resume',
    'KeySkills',
    'StatusId',
    'Portfolio',
    'Type',
    'CurrentLocation',
    'PreferredLocation',
    'Height',
    'Weight',
    'BloodGroup',
    'Hemoglobin%',
    'NoticePeriod',
    'CurrentOrganization',
    'Certificates',
    'Remarks',
    'Feedback',
    'CreatedOn',
  ];

  public $timestamps = false; // Disable default timestamps

}
