<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $fillable = [
        'id',
        'RoleName',
        'created_at',
        'updated_at',
        ];
}
