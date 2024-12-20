<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index()
  {
    return view('screens.users.user');
  }

  public function userform($id = null)
  {
    
    if($id){
      $user = UserModel::find($id);
      if($user){
        return view('screens.users.userCreate', compact('user'));
      }else{
        return view('screens.users.userCreate');
      }
    }else{
      return view('screens.users.userCreate');
    }
  }
  

  public function getuser($id = null)
  {
      if ($id !== null) {
          // Fetch single user by ID
          try {
              $user = UserModel::findOrFail($id);
              return response()->json([
                  'status' => 200,
                  'data' => $user,
              ], 200);
          } catch (ModelNotFoundException $e) {
              return response()->json([
                  'status' => 404,
                  'message' => "User with the given ID not found",
              ], 404);
          }
      } else {
          // Fetch all users
          $alluser = UserModel::all();
          if ($alluser->isEmpty()) {
              return response()->json([
                  'status' => 404,
                  'message' => "No users found",
              ], 404);
          }
  
          return response()->json([
              'status' => 200,
              'data' => $alluser,
          ], 200);
      }
  }
  

public function store(Request $request)
{
    
    $user = UserModel::create([
        'Name' => $request->username,
        'RoleId' => $request->role_id,
        'Email' => $request->email,
        'Password' => bcrypt($request->password),
    ]);

    if($user){
    return response()->json([
      'status' =>200,
      'message' => 'User added successfully',
      'user' => $user,
    ],200);
    }
    else{
      return response()->json([
        'status' =>404,
        'message' => 'Already Exist',
      ],404);
    }
}


public function show($id)
{
    $user = UserModel::find($id);
    if ($user) {
        return response()->json([
            'status' => 200,
            'data' => $user,
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
        ], 404);
    }
}

public function update(Request $request, $id)
    {
        // Find the user by ID
        $user = UserModel::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Update user details directly from the request
        $user->Name = $request->input('username');
        $user->Email = $request->input('email');
        $user->RoleId = $request->input('role_id');

        // If password is provided, hash it before saving
        if ($request->has('password') && !empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

        // Save the updated user information
        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);
    }

    // Delete User

    public function delete($id)
    {
      $user = UserModel::find($id);
      if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
        }
    }

