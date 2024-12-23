<?php

namespace App\Http\Controllers\Applicants;

use App\Http\Controllers\Controller;
use App\Models\ApplicantModel;
use Exception;
use Illuminate\Http\Request;

class ApplicantsApplyController extends Controller
{
    public function applicantsapply()
    {
        return view('screens.Applicants.applicantsapply');
    }
    public function smapplicantslist()
    {
        return view('screens.Applicants.smapplicantslist');
    }
    public function applicantlist()
    {
        return view('screens.Applicants.applicantlist');
    }

    public function createApplicant(Request $request)
  {
    try {

      $existingMobile = ApplicantModel::where('PhoneNumber', $request->phone)->first();
      $existingEmail = ApplicantModel::where('Email', $request->email)->first();

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
        $applicants = ApplicantModel::create([
            // 'job'
          'Name' => $request->name,
          'Email' => $request->email,
          'Phone' => $request->phone,
          'Location' => $request->location,
        ]);

        return response()->json([
          'status' => 'success',
          'message' => 'Employer created successfully!',
          'data' => $applicants
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
}
