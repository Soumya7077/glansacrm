<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    use HasFactory;
    protected $table = 'departments';
    protected $fillable = [
        'Name',
        'created_at',
        'updated_at'
        ];
}
