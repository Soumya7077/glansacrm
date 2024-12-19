<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
