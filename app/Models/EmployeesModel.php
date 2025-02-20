<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesModel extends Model
{
  use HasFactory;
  protected $table = 'employees';
  protected $fillable = [
    'OrganizationName',
    'FirstContactPersonName',
    'FirstContactPhoneNumber',
    'FirstContactEmail',
    'FirstContactLocation',
    'FirstContactDesignation',
    'SecondContactPersonName',
    'SecondContactPhoneNumber',
    'SecondContactEmail',
    'SecondContactLocation',
    'SecondContactDesignation',
    'created_at',
    'updated_at'
  ];

  public function interviews()
    {
        return $this->hasMany(ScheduleInterviewModel::class, 'EmployerId');
    }

}
