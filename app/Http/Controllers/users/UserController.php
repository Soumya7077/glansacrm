<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


  // public function __construct()
  // {
  //   $this->middleware('auth:api', ['except' => ['login']]);
  // }

  public function login()
  {
    try {
      $credentials = request(['Email', 'Password']);

      if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
      }

      return $this->respondWithToken($token);
    } catch (\Throwable $e) {

      // Log the exception for debugging
      // \Log::error('Login error: ' . $e->getMessage(), [
      //   'file' => $e->getFile(),
      //   'line' => $e->getLine(),
      //   'trace' => $e->getTraceAsString(),
      // ]);

      // Return a generic error response
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }


  public function index()
  {
    return view('screens.users.user');
  }

  public function userform($id = null)
  {

    if ($id) {
      $user = UserModel::find($id);
      if ($user) {
        return view('screens.users.userCreate', compact('user'));
      } else {
        return view('screens.users.userCreate');
      }
    } else {
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

    if ($user) {
      return response()->json([
        'status' => 200,
        'message' => 'User added successfully',
        'user' => $user,
      ], 200);
    } else {
      return response()->json([
        'status' => 404,
        'message' => 'Already Exist',
      ], 404);
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


  // Get Recruiter List

  public function getRecruiter()
  {
    try {
      $recruiter = UserModel::where('RoleId', 2)->get();
      if ($recruiter) {
        return response()->json([
          'status' => 'success',
          'message' => 'Recruiter Fetch Successfully',
          'data' => $recruiter
        ], 200);
      } else {
        return response()->json([
          'status' => 'error',
          'message' => 'No Recruiter Found Kindly Create One',
          'data' => $recruiter
        ], 400);
      }
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}
