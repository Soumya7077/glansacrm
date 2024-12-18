<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    return view('screens.users.user');
  }

  public function userform()
  {
    return view('screens.users.userCreate');
  }
}
