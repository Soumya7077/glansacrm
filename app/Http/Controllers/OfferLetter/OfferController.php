<?php

namespace App\Http\Controllers\OfferLetter;

use App\Http\Controllers\Controller;
use App\Models\OnboardModel;
use Exception;
use Illuminate\Http\Request;

class OfferController extends Controller
{
  public function offer()
  {
    return view('screens.OfferLetter.offerLetter');
  }

  public function offerletter(Request $request)
  {
    try {
      // Check if phone or email already exists


      $offerLetterPath = $request->Resume; // Preserve current resume
      $email = $request->email;
      if ($request->hasFile('Resume')) {
        // Create a folder with the applicant's name (sanitize the name to avoid invalid characters)
        $applicantName = preg_replace('/[^A-Za-z0-9]/', '_', $request->Name);
        $folderPath = "resumes/{$applicantName}";

        // Store the new resume file in the specific folder
        $offerLetterPath = $request->file('Resume')->store($folderPath, 'public');
      }
      $applicants = OnboardModel::create([
        // 'job'
        'ApplicantId' => $request->ApplicantId,
        'JobId' => $request->JobId,
        'InterviewId' => $request->InterviewId,
        'EmployerId' => $request->EmployerId,
        'FolderPath' => $offerLetterPath,
        'Subject' => $request->Subject,
        'SalaryOffer' => $request->SalaryOffer,
        'JoiningDate' => $request->JoiningDate,
        'Shift' => $request->Shift,
        'Benefits' => $request->Benefits,
        'Remark' => $request->Remark,
        'CreatedBy' => $request->CreatedBy,
        'Status' => $request->Status,
        'CreatedOn' => now()
      ]);

      return response()->json([
        'status' => 'success',
        'message' => 'Offer letter send to selected candidate',
        'data' => $applicants
      ], 201);


    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500); // Internal Server Error status code
    }
  }
}
