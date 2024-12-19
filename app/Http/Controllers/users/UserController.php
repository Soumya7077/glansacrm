<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
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
public function getuser()
{
  $users = UserModel::all();
  if($users->count() >0)
  {
    return response()->json([
      'status' =>200,
      'data' => $users,
    ],200);
  }
  else{
    return response()->json([
      'status' =>404,
      'message' => 'No users found',
      ],404);
  }
}
}
