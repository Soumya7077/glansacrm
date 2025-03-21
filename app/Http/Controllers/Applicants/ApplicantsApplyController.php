<?php

namespace App\Http\Controllers\Applicants;

use App\Http\Controllers\Controller;
use App\Models\ApplicantModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantsApplyController extends Controller
{

  public function socialMediaForm()
  {
    return view('screens.SocialMedia.socialMediaForm');
  }
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
  public function allapplicantlist()
  {
    return view('screens.Applicants.allApplicantlist');
  }

  /**==============================New Applicant create======================= */

  public function createApplicant(Request $request)
{
    try {
        // Check if the phone number or email already exists for the given job post
        $existingApplicant = ApplicantModel::where('jobpost_id', $request->jobpost_id)
            ->where(function ($query) use ($request) {
                $query->where('PhoneNumber', $request->phone)
                      ->orWhere('Email', $request->email);
            })->first();

        if ($existingApplicant) {
            return response()->json([
                'status' => 'error',
                'message' => 'You have already applied with this phone number or email!'
            ], 400);
        }

        // Handle resume upload
        $resumePath = $request->Resume; // Preserve existing resume path
        if ($request->hasFile('Resume')) {
            // Create a folder with the applicant's sanitized name
            $applicantName = preg_replace('/[^A-Za-z0-9]/', '_', $request->Name);
            $folderPath = "resumes/{$applicantName}";

            // Store the new resume file in the specific folder
            $resumePath = $request->file('Resume')->store($folderPath, 'public');
        }

        // Create applicant
        $applicant = ApplicantModel::create([
            'jobpost_id' => $request->jobpost_id,
            'Source' => $request->Source,
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'Email' => $request->email,
            'PhoneNumber' => $request->phone,
            'Experience' => $request->Experience,
            'CurrentSalary' => $request->CurrentSalary,
            'ExpectedSalary' => $request->ExpectedSalary,
            'Resume' => $resumePath,
            'KeySkills' => $request->KeySkills,
            'Qualification' => $request->Qualification,
            'StatusId' => $request->StatusId,
            'Portfolio' => $request->Portfolio,
            'Type' => $request->Type,
            'CurrentLocation' => $request->CurrentLocation,
            'PreferredLocation' => $request->PreferredLocation,
            'Height' => $request->Height,
            'Weight' => $request->Weight,
            'BloodGroup' => $request->BloodGroup,
            'Hemoglobin%' => $request->Hemoglobin,
            'NoticePeriod' => $request->NoticePeriod,
            'CurrentOrganization' => $request->CurrentOrganization,
            'Certificates' => $request->Certificates,
            'Remarks' => $request->Remarks,
            'Feedback' => $request->Feedback,
            'CreatedOn' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Applicant created successfully!',
            'data' => $applicant
        ], 201);

    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong! Please try again.',
            'error' => $e->getMessage()
        ], 500); // Internal Server Error status code
    }
}


  // public function createApplicant(Request $request)
  // {
  //   try {
  //     // Check if phone or email already exists
  //     $existingMobile = ApplicantModel::where('PhoneNumber', $request->phone)
  //       ->where('jobpost_id', $request->jobpost_id)
  //       ->exists();

  //     $existingEmail = ApplicantModel::where('Email', $request->email)
  //       ->where('jobpost_id', $request->jobpost_id)
  //       ->exists();
  //     // $existingJob = ApplicantModel::where('jobpost_id', $request->jobpost_id)->first();



  //     if ($existingMobile) {
  //       return response()->json([
  //         'status' => 'error',
  //         'message' => 'You have already aplied for this job!'
  //       ], 400);
  //     } elseif ($existingEmail) {
  //       return response()->json([
  //         'status' => 'error',
  //         'message' => 'Email already exists!'
  //       ], 400);
  //     }

  //     if ($existingMobile) {
  //       return response()->json([
  //         'status' => 'error',
  //         'message' => 'Phone Number already exists!'
  //       ], 400);
  //     } else if ($existingEmail) {
  //       return response()->json([
  //         'status' => 'error',
  //         'message' => 'Email already exists!'
  //       ], 400);
  //     } else {

  //       $resumePath = $request->Resume; // Preserve current resume
  //       if ($request->hasFile('Resume')) {
  //         // Create a folder with the applicant's name (sanitize the name to avoid invalid characters)
  //         $applicantName = preg_replace('/[^A-Za-z0-9]/', '_', $request->Name);
  //         $folderPath = "resumes/{$applicantName}";

  //         // Store the new resume file in the specific folder
  //         $resumePath = $request->file('Resume')->store($folderPath, 'public');
  //       }
  //       $applicants = ApplicantModel::create([
  //         // 'job'
  //         'jobpost_id' => $request->jobpost_id,
  //         'Source' => $request->Source,
  //         'FirstName' => $request->FirstName,
  //         'LastName' => $request->LastName,
  //         'Email' => $request->email,
  //         'PhoneNumber' => $request->phone,
  //         'Experience' => $request->Experience,
  //         'CurrentSalary' => $request->CurrentSalary,
  //         'ExpectedSalary' => $request->ExpectedSalary,
  //         'Resume' => $resumePath,
  //         'KeySkills' => $request->KeySkills,
  //         'Qualification' => $request->Qualification,
  //         'StatusId' => $request->StatusId,
  //         'Portfolio' => $request->Portfolio,
  //         'Type' => $request->Type,
  //         'CurrentLocation' => $request->CurrentLocation,
  //         'PreferredLocation' => $request->PreferredLocation,
  //         'Height' => $request->Height,
  //         'Weight' => $request->Weight,
  //         'BloodGroup' => $request->BloodGroup,
  //         'Hemoglobin%' => $request->Hemoglobin,
  //         'NoticePeriod' => $request->NoticePeriod,
  //         'CurrentOrganization' => $request->CurrentOrganization,
  //         'Certificates' => $request->Certificates,
  //         'Remarks' => $request->Remarks,
  //         'Feedback' => $request->Feedback,
  //         'CreatedOn' => now(),
  //       ]);

  //       return response()->json([
  //         'status' => 'success',
  //         'message' => 'Applicant created successfully!',
  //         'data' => $applicants
  //       ], 201);

  //     }
  //   } catch (Exception $e) {
  //     return response()->json([
  //       'status' => 'error',
  //       'message' => 'Something went wrong! Please try again.',
  //       'error' => $e->getMessage()
  //     ], 500); // Internal Server Error status code
  //   }
  // }

  /**==============================New Applicant create======================= */


  /**===============================Get All applicant list================== */

  public function getApplicant()
  {
    try {
      $applicantlist = DB::table('applicant')
        ->join('job_post', 'applicant.jobpost_id', '=', 'job_post.id')
        ->join('status', 'status.id', '=', 'applicant.StatusId')
        ->join('employees', 'employees.id', '=', 'job_post.EmployerId')
        ->where('applicant.Source', '=', 'Website')
        ->orWhere('applicant.Source', '=', 'Enquiry')
        ->select(
          'applicant.*',
          'job_post.Title',
          'job_post.Description',
          'status.id as sid',
          'status.name as sname',
          'employees.OrganizationName',
          'employees.id as empId',
        )->get();





      if ($applicantlist) {
        return response()->json([
          'status' => 'success',
          'message' => 'Applicant List Fetch successfully!',
          'data' => $applicantlist
        ], 200);
      } else {
        return response()->json([
          'status' => 'error',
          'message' => 'No data found!',
          'data' => $applicantlist
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

  /**==============================Get All applicant List======================= */


  /**==============================Get Applicant by id====================== */


  public function getApplicantById($id)
  {
    try {
      if ($id) {
        $applicant = ApplicantModel::find($id);
        if ($applicant) {
          return response()->json([
            'status' => 'success',
            'message' => 'Applicant fetch by id successful',
            'data' => $applicant,
          ], 200);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Data not found',
            'data' => $applicant,
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

  /**==============================Get Applicant by id====================== */


  /**==============================Update Applicant ======================= */

  public function updateApplicant(Request $request, $id)
  {
    try {
      // Find the applicant by ID
      $applicant = ApplicantModel::find($id);

      if (!$applicant) {
        return response()->json([
          'status' => 'error',
          'message' => 'Applicant not found!'
        ], 404); // Not Found status code
      }

      // Check for duplicate phone number or email (excluding the current applicant)
      $existingMobile = ApplicantModel::where('PhoneNumber', $request->PhoneNumber)
        ->where('id', '!=', $id)
        ->first();
      $existingEmail = ApplicantModel::where('Email', $request->Email)
        ->where('id', '!=', $id)
        ->first();

      if ($existingMobile) {
        return response()->json([
          'status' => 'error',
          'message' => 'Phone Number already exists!'
        ], 400);
      } elseif ($existingEmail) {
        return response()->json([
          'status' => 'error',
          'message' => 'Email already exists!'
        ], 400);
      }

      // Handle resume file upload
      $resumePath = $applicant->Resume; // Preserve current resume
      if ($request->hasFile('Resume')) {
        // Create a folder with the applicant's name (sanitize the name to avoid invalid characters)
        $applicantName = preg_replace('/[^A-Za-z0-9]/', '_', $request->Name);
        $folderPath = "resumes/{$applicantName}";

        // Store the new resume file in the specific folder
        $resumePath = $request->file('Resume')->store($folderPath, 'public');
      }

      // Update applicant details
      $applicant->update([
        'jobpost_id' => $request->jobpost_id,
        'Source' => $request->Source,
        'FirstName' => $request->FirstName,
        'LastName' => $request->LastName,
        'Email' => $request->email,
        'PhoneNumber' => $request->phone,
        'Experience' => $request->Experience,
        'CurrentSalary' => $request->CurrentSalary,
        'ExpectedSalary' => $request->ExpectedSalary,
        'Resume' => $resumePath,
        'KeySkills' => $request->KeySkills,
        'StatusId' => $request->StatusId,
        'Portfolio' => $request->Portfolio,
        'Type' => $request->Type,
        'CurrentLocation' => $request->CurrentLocation,
        'PreferredLocation' => $request->PreferredLocation,
        'Height' => $request->Height,
        'Weight' => $request->Weight,
        'BloodGroup' => $request->BloodGroup,
        'Hemoglobin%' => $request->Hemoglobin,
        'NoticePeriod' => $request->NoticePeriod,
        'CurrentOrganization' => $request->CurrentOrganization,
        'Certificates' => $request->Certificates,
        'Remarks' => $request->Remarks,
        'Feedback' => $request->Feedback,
        // 'CreatedOn' => $request->CreatedOn,

      ]);

      return response()->json([
        'status' => 'success',
        'message' => 'Applicant updated successfully!',
        'data' => $applicant
      ], 200);

    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500); // Internal Server Error status code
    }
  }

  /**==============================Update Applicant ======================= */


  /**==========================Delete Applicant============================ */

  public function deleteApplicant($id)
  {
    try {
      $employer = ApplicantModel::find($id);
      if (!$employer) {
        return response()->json(['error' => 'Applicant not found'], 404);
      }
      $employer->delete();
      return response()->json(['message' => 'Applicant deleted successfully'], 200);

    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  /**==========================Delete Applicant============================ */

  /**============================Get Applicant list by Job Id==================== */

  public function getApplicantByJobId(Request $request, $id)
  {
    try {
      $applicant = ApplicantModel::where('jobpost_id', $id)->get();
      return response()->json([
        'status' => 'success',
        'message' => 'Applicant fetch by job id successfully!',
        'data' => $applicant
      ], 200);

    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500); // Internal Server Error status code
    }
  }

  /**============================Get Applicant list by Job Id==================== */




  /**=====================================Get social media applicant============================== */


  public function getSocialMediaApplicant()
{
    try {
        $applicants = ApplicantModel::where('Source', '=', 'sm')->get();

        foreach ($applicants as $app) {
            $jobPost = DB::table('social_media_assign')->where('ApplicantId', $app->id)->first();
            $app->isAssigned = $jobPost ? true : false; // Adding isAssigned dynamically
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Applicants fetched by social media successfully!',
            'data' => $applicants
        ], 200);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong! Please try again.',
            'error' => $e->getMessage()
        ], 500);
    }
}




  /**=====================================Get social media applicant============================== */


  /**====================================Update Applicant Status================================ */

  public function applicantStatusUpdate(Request $request, $id)
  {
    try {
      $applicant = ApplicantModel::find($id);

      $applicant->StatusId = $request->status;
      $applicant->Feedback = $request->feedback;

      $applicant->save();

      return response()->json([
        'status' => 'success',
        'message' => 'Applicant Status Updated successfully',
        'data' => $applicant
      ], 200);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500); // Internal Server Error status code
    }
  }

  /**====================================Update Applicant Status================================ */



  /**===================================Get Formatted Applicant List=========================== */

  public function getFormattedApplicantListByRecruiter($id)
  {
    try {
      $applicantlist = DB::table('applicant')
        ->join('job_post', 'applicant.jobpost_id', '=', 'job_post.id')
        ->join('status', 'status.id', '=', 'applicant.StatusId')
        ->join('employees', 'employees.id', '=', 'job_post.EmployerId')
        ->join('recruiter_assign', 'recruiter_assign.JobId', '=', 'applicant.jobpost_id')
        ->where('recruiter_assign.UserId', '=', $id)
        ->where('applicant.Source', '=', 'Website')
        ->orWhere('applicant.Source', '=', 'Enquiry')
        ->select(
          'applicant.*',
          'job_post.Title',
          'job_post.Description',
          'status.id as sid',
          'status.name as sname',
          'employees.OrganizationName',
          'employees.id as empId',
        )->get();





      if ($applicantlist) {
        return response()->json([
          'status' => 'success',
          'message' => 'Applicant List Fetch successfully!',
          'data' => $applicantlist
        ], 200);
      } else {
        return response()->json([
          'status' => 'error',
          'message' => 'No data found!',
          'data' => $applicantlist
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

  /**===================================Get Formatted Applicant List=========================== */


}
