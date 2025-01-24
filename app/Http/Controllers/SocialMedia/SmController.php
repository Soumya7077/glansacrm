<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
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

      $assignRecruiter = SocialMediaAssignModel::create([
        'ApplicantId' => $request->applicantId,
        'UserId' => $request->userId,
        'AssignedBy' => $request->assignedBy,
        'AssignOn' => now(),
        'created_at' => now(),
      ]);

      if ($assignRecruiter) {
        return response()->json([
          'status' => 'success',
          'message' => 'Recruiter assigned successfully',
          'data' => $assignRecruiter,
        ], 201);
      }

    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong, ' . $e->getMessage(),
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
