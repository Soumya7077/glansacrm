<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'user';
    protected $fillable = [
        'Name',
        'Email',
        'Password',
        'RoleId',
        'CreatedOn',
        'CreatedBy',
        'ModifyOn',
        'ModifyBy'
        ];

        // Disable default timestamps (created_at, updated_at)
    public $timestamps = false;

    // Use custom timestamp fields
    const CREATED_AT = 'CreatedOn';
    const UPDATED_AT = 'ModifyOn';
}
