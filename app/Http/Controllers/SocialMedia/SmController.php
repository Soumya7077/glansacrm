<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use App\Models\ApplicantModel;
use App\Models\SocialMediaAssignModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmController extends Controller
{
  public function smform()
  {
    return view('screens.SocialMedia.socialMediaForm');
  }
  public function smlist()
  {
    return view('screens.SocialMedia.socialmedialist');
  }


  /**===================Assign Social media candidates to recruiter====================== */

  public function assignSocialMediaApplicantsToRecruiter(Request $request)
{
    try {
        // Initialize an array to store failed assignments
        $failedAssignments = [];

        // Loop through each applicant
        foreach ($request->applicantIds as $applicantId) {
            // Check if the applicant is already assigned to a recruiter
            $existingAssignment = SocialMediaAssignModel::where('ApplicantId', $applicantId)->first();

            if ($existingAssignment) {
                // If already assigned, add to the failedAssignments array
                $failedAssignments[] = $applicantId;
                $applicantName[] = ApplicantModel::where('id', $applicantId)->first()->FirstName;
            } else {
                // Otherwise, create a new assignment
                SocialMediaAssignModel::create([
                    'ApplicantId' => $applicantId,
                    'UserId' => $request->userId,
                    'AssignedBy' => $request->assignedBy,
                    'AssignOn' => now(),
                    'created_at' => now(),
                ]);
            }
        }

        // If there are failed assignments, return an error message with the applicants that were already assigned
        if (!empty($failedAssignments)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The following applicants are already assigned to a recruiter: ' . implode(', ', $applicantName),
            ], 400);
        }

        // If no applicants are failed, return success
        return response()->json([
            'status' => 'success',
            'message' => 'Applicants assigned successfully.',
        ], 201);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong: ' . $e->getMessage(),
        ], 500);
    }
}



  /**===================Assign Social media candidates to recruiter====================== */



  /**========================Get All Social media Applicant list========================== */

  public function getAllSocialMediaApplicantListByRecruiter($id)
  {
    try {
      $assignedRecruiter = DB::table('social_media_assign')
        ->join('applicant', 'applicant.id', '=', 'social_media_assign.ApplicantId')
        ->where('social_media_assign.UserId', $id)
        ->select('social_media_assign.*', 'applicant.*')
        ->get();

      if ($assignedRecruiter) {
        return response()->json([
          'status' => 'success',
          'message' => 'Get Assigned Recruiter',
          'data' => $assignedRecruiter,
        ], 200);
      }
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong, ' . $e->getMessage(),
      ], 500);
    }
  }

  /**========================Get All Social media Applicant list========================== */


  /**==============================Get All Sm applicant list============================= */

  public function getAllSocialMediaApplicantList()
  {
    try {
      $assignedRecruiter = DB::table('social_media_assign')
        ->join('applicant', 'applicant.id', '=', 'social_media_assign.ApplicantId')
        ->select('social_media_assign.*', 'applicant.*')
        ->get();

      if ($assignedRecruiter) {
        return response()->json([
          'status' => 'success',
          'message' => 'Get Assigned Recruiter',
          'data' => $assignedRecruiter,
        ], 200);
      }
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong, ' . $e->getMessage(),
      ], 500);
    }
  }

  /**==============================Get All Sm applicant list============================= */


  /**==================================Get Social media applicant by recruiter id================= */



  public function getSocialMediaApplicantByRecruiter($id)
  {
    try {
      $assignedData = DB::table('social_media_assign')
        ->join('applicant', 'applicant.id', '=', 'social_media_assign.ApplicantId')
        ->where('social_media_assign.UserId', '=', $id)
        ->select('social_media_assign.*', 'applicant.*')
        ->get();


      if ($assignedData) {
        return response()->json([
          'status' => 'success',
          'message' => 'Get Assigned Recruiter',
          'data' => $assignedData,
        ], 200);
      }
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong, ' . $e->getMessage(),
      ], 500);
    }
  }


  /**==================================Get Social media applicant by recruiter id================= */


}
