<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserCreate extends Controller
{
  public function index()
  {
    return view('content.users.user');
  }
}