<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaAssignModel extends Model
{
    use HasFactory;

    protected $table = 'social_media_assign';
  protected $fillable = [
    'UserId',
    'ApplicantId',
    'AssignedBy',
    'AssignOn',
    'UpdatedBy',
    'UpdatedOn',
  ];
}
