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
        // Check if phone or email already exists
        $existingMobile = ApplicantModel::where('PhoneNumber', $request->PhoneNumber)->first();
        $existingEmail = ApplicantModel::where('Email', $request->email)->first();
        $existingJob = ApplicantModel::where('jobpost_id', $request->jobpost_id)->first();

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

        elseif ($existingJob) {
            return response()->json([
                'status' => 'error',
                'message' => 'Already Applied for this Job!'
            ], 400);
        }

        // Handle resume file upload
        $resumePath = null;
        if ($request->hasFile('Resume')) {
            // Create a folder with the applicant's name (sanitize the name to avoid invalid characters)
            $applicantName = preg_replace('/[^A-Za-z0-9]/', '_', $request->Name);
            $folderPath = "resumes/{$applicantName}";

            // Store the resume file in the specific folder
            $resumePath = $request->file('Resume')->store($folderPath, 'public');
        }

        // Create applicant
        $applicant = ApplicantModel::create([
            'jobpost_id' => $request->jobpost_id,
            'Source' => $request->Source,
            'Name' => $request->Name,
            'Email' => $request->Email,
            'PhoneNumber' => $request->PhoneNumber,
            'Experience' => $request->Experience,
            'CurrentSalary' => $request->CurrentSalary,
            'ExpectedSalary' => $request->ExpectedSalary,
            'Qualification' => $request->Qualification,
            'Resume' => $resumePath, // Save the file path
            'KeySkills' => $request->KeySkills,
            'StatusId' => $request->StatusId,
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

public function getApplicant()
  {
    try {
      $applicantlist = ApplicantModel::all();

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

  // Get Employer list by id

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
            'Name' => $request->Name,
            'Email' => $request->Email,
            'PhoneNumber' => $request->PhoneNumber,
            'Experience' => $request->Experience,
            'CurrentSalary' => $request->CurrentSalary,
            'ExpectedSalary' => $request->ExpectedSalary,
            'Qualification' => $request->Qualification,
            'Resume' => $resumePath, // Save the updated file path
            'KeySkills' => $request->KeySkills,
            'StatusId' => $request->StatusId,
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

// Delete employer

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

}
