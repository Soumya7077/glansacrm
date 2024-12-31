<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use App\Models\EmployeesModel;
use Exception;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
  public function index()
  {
    return view('screens.employer.employer-list');
  }

  public function employerForm($id = null)
  {
    return view('screens.employer.employer-form');
  }


  // employer create

  public function createEmployer(Request $request)
  {
    try {

      $existingMobile = EmployeesModel::where('Phone', $request->phone)->first();
      $existingEmail = EmployeesModel::where('Email', $request->email)->first();

      if ($existingMobile) {
        return response()->json([
          'status' => 'error',
          'message' => 'Phone Number already exists!'
        ], 400);
      } else if ($existingEmail) {
        return response()->json([
          'status' => 'error',
          'message' => 'Email already exists!'
        ], 400);
      } else {
        $employer = EmployeesModel::create([
          'Name' => $request->name,
          'Email' => $request->email,
          'Phone' => $request->phone,
          'Location' => $request->location,
        ]);

        return response()->json([
          'status' => 'success',
          'message' => 'Employer created successfully!',
          'data' => $employer
        ], 201);
      }


    } catch (Exception $e) {
      // Handle the exception
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500); // Internal Server Error status code
    }
  }


  // Get all Employer  list

  public function getAllEmployees()
  {
    try {
      $employerList = EmployeesModel::all();

      if ($employerList) {
        return response()->json([
          'status' => 'success',
          'message' => 'Employer List Fetch successfully!',
          'data' => $employerList
        ], 200);
      } else {
        return response()->json([
          'status' => 'error',
          'message' => 'No data found!',
          'data' => $employerList
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


  // Get Employer list by id

  public function getEmployerById($id)
  {
    try {
      if ($id) {
        $employer = EmployeesModel::find($id);
        if ($employer) {
          return response()->json([
            'status' => 'success',
            'message' => 'Employer fetch by id successful',
            'data' => $employer,
          ], 200);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Data not found',
            'data' => $employer,
          ], 400);
        }
      }
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }


  // Update Employer list by id

  public function UpdateEmployer(Request $request, $id)
  {
    try {
      $employer = EmployeesModel::find($id);

      if (!$employer) {
        return response()->json(['error' => 'Employer not found'], 404);
      }

      $employer->Name = $request->input('name');
      $employer->Email = $request->input('email');
      $employer->Phone = $request->input('phone');
      $employer->Location = $request->input('location');

      $employer->save();

      return response()->json(['message' => 'Employer updated successfully', 'user' => $employer], 200);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }


  // Delete employer

  public function deleteEmployer($id)
  {
    try {
      $employer = EmployeesModel::find($id);
      if (!$employer) {
        return response()->json(['error' => 'Employer not found'], 404);
      }
      $employer->delete();
      return response()->json(['message' => 'Employer deleted successfully'], 200);

    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}
