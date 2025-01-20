<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetMail;
use App\Models\UserModel;
use Exception;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{


  // public function __construct()
  // {
  //   $this->middleware('auth:api', ['except' => ['login']]);
  // }

  public function login(Request $request)
  {
    $user = UserModel::where('Email', $request->Email)->first();

    if ($user && Hash::check($request->Password, $user->Password)) {
      $token = Auth::guard('user')->login($user);
      return $this->respondWithToken($token);
      // return response()->json([
      //     'message' => 'Login successful',
      //     'token' => $token,
      //     'user' => $user,
      // ]);

    }

    return response()->json(['error' => 'Invalid email or password'], 401);

  }

  public function me()
  {
    return response()->json(Auth::guard('user')->user());
  }

  public function logout()
  {
    auth()->logout();
    return response()->json(['message' => 'Logged out successfully']);
  }



  protected function respondWithToken($token)
  {

    session('token', $token);

    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer'
      // 'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }


  /**===================================Password reset functionality========================== */


  public function resetpassword(Request $request)
  {
    try {
      $user = UserModel::where('Email', $request->Email)->first();

      if ($user) {

        $user->Password = $request->input('newPassword');
        $user->save();

        return response()->json(['message' => 'Password updated successfully', 'user' => $user], 200);
      } else {
        return response()->json(['message' => 'Email Not Found'], 200);
      }
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }


  /**===================================Password reset functionality========================== */




  public function forgotPassword(Request $request)
  {
    try {
      // Validate the email
      $request->validate([
        'Email' => 'required|email|exists:user,Email', // Ensure email exists in 'user' table
      ]);

      // Get the user by email
      $user = UserModel::where('Email', $request->Email)->first();

      if ($user) {
        // Generate a reset link
        $resetLink = url('/reset-password?email=' . urlencode($user->Email));

        // Send the password reset email with the link
        Mail::to($user->Email)->send(new PasswordResetMail($resetLink));

        return response()->json(['message' => 'Password reset link has been sent to your email.']);
      } else {
        return response()->json(['message' => 'Email not found.'], 404);
      }
    } catch (\Exception $e) {
      return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
    }
  }


  /**===================================Change Password functionality========================== */

  public function changePassword(Request $request)
  {

    try{
      $user = UserModel::where('Email', $request->Email)->first();


    if ($user) {
      $currentPass = $request->currentPass;
      $newPass = $request->newPass;

      if (!Hash::check($currentPass, $user->Password)) {
        return response()->json(['error' => 'Current password is incorrect.'], 400);
      } else {
        $user->Password = Hash::make($newPass);
        $user->save();
        return response()->json(['success' => 'Password updated successfully.']);
      }
    } else {
      return response()->json(['error' => 'Provided email not found'], 400);
    }

    }catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
    // // Validate the request
    // $request->validate([
    //   'currentPass' => 'required',
    //   'newPass' => 'required|min:8|confirmed', // Laravel automatically checks confirmPass
    // ]);


    // // Verify the current password
    // if (!Hash::check($request->currentPass, $user->Password)) {
    //   return response()->json(['error' => 'Current password is incorrect.'], 400);
    // }

    // // Update the user's password
    // $user->Password = Hash::make($request->newPass);
    // $user->save();


  }

  public function changepassview()
  {
    return view('screens.ChangePassword.changepassword');
  }

  public function emailpage()
  {



    return view('screens.email.password_reset');
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
      'FirstName' => $request->first_name,
      'LastName' => $request->last_name,
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
    $user->FirstName = $request->input('first_name');
    $user->LastName = $request->input('last_name');
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
