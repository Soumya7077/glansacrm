<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruiterAssignsModel extends Model
{
    use HasFactory;
    protected $table = 'recruiter_assign';
    protected $fillable = [
        'JobId ',
        'UserId',
        'AssignedBy',
        'AssignOn',
        'UpdatedBy',
        'UpdatedOn',
        'created_at',
        'updated_at',
        ];
}
