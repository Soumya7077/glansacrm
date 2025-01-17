<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject
{

  use HasApiTokens, HasFactory, Notifiable;


  protected $table = 'user';
  protected $guard = 'user';
  protected $fillable = [
    'FirstName',
    'LastName',
    'Email',
    'Password',
    'RoleId',
    'CreatedOn',
    'CreatedBy',
    'ModifyOn',
    'ModifyBy'
  ];
  public function getJWTIdentifier()
  {
    return $this->getKey();
  }


  public function getJWTCustomClaims()
  {
    return [];
  }



  // Disable default timestamps (created_at, updated_at)
  public $timestamps = false;

  // Use custom timestamp fields
  const CREATED_AT = 'CreatedOn';
  const UPDATED_AT = 'ModifyOn';


  protected $casts = [
    // 'email_verified_at' => 'datetime',
    'Password' => 'hashed',
  ];


}
