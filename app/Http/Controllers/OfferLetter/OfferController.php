<?php

namespace App\Http\Controllers\OfferLetter;

use App\Http\Controllers\Controller;
use App\Models\ApplicantModel;
use App\Models\EmployeesModel;
use App\Models\JobPostModel;
use App\Models\OnboardModel;
use Exception;
use Illuminate\Http\Request;
use App\Mail\OfferLetterMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OfferController extends Controller
{
public function offerletter(Request $request)
{
    try {
        // Validate input data
        $request->validate([
            'FolderPath' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'email' => 'required|email',
            'ApplicantId' => 'required',
            'JobId' => 'required',
            'InterviewId' => 'required',
            'EmployerId' => 'required',
            'Subject' => 'required|string',
            'SalaryOffer' => 'required|numeric',
            'JoiningDate' => 'required|date',
            'Shift' => 'required|string',
            'Benefits' => 'nullable|string',
            'Remark' => 'nullable|string',
        ]);

        $email = $request->email;

        // Fetch related data for applicant, job, and organization
        $applicant = ApplicantModel::find($request->ApplicantId); // Replace with your actual applicant model
        $job = JobPostModel::find($request->JobId); // Replace with your actual job model
        $organization = EmployeesModel::find($request->EmployerId); // Replace with your actual organization model

        if (!$applicant || !$job || !$organization) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid Applicant, Job, or Employer details.',
            ], 404);
        }

        // Handle file upload
        $offerLetterPath = null;
        if ($request->hasFile('offer_letters') && $request->file('offer_letters')->isValid()) {
            // Get the file extension
            $fileExtension = $request->file('offer_letters')->getClientOriginalExtension();
            
            // Generate the custom filename based on applicant's first name
            $filename = $applicant->FirstName . '_offer_letter.' . $fileExtension;
        
            // Store the file with the custom filename in the 'offer_letters' directory
            $offerLetterPath = $request->file('offer_letters')->storeAs('offer_letters', $filename, 'public');
        }
        

        // Save to OnboardModel
        $applicants = OnboardModel::create([
            'ApplicantId' => $request->ApplicantId,
            'JobId' => $request->JobId,
            'InterviewId' => $request->InterviewId,
            'EmployerId' => $request->EmployerId,
            'FolderPath' => $offerLetterPath,
            'Subject' => $request->Subject,
            'SalaryOffer' => $request->SalaryOffer,
            'JoiningDate' => $request->joiningDate,
            'Shift' => $request->Shift,
            'Benefits' => $request->Benefits,
            'Remark' => $request->Remark,
            'CreatedBy' => $request->CreatedBy,
            'Status' => $request->Status,
            'CreatedOn' => now(),
        ]);

        // Prepare email details
        $details = [
            'name' => $applicant->FirstName . ' ' . $applicant->LastName,
            'designation' => $job->Title,
            'organization' => $organization->OrganizationName,
            'salary' => $request->SalaryOffer,
            'joining_date' => $request->JoiningDate,
            'shift' => $request->Shift,
            'benefits' => $request->Benefits,
            'remarks' => $request->Remark,
        ];

        // Send email with offer letter
       

        Mail::send('email.offer_latter', $details, function ($message) use ($email, $details, $offerLetterPath) {
            $message->to($email)
                    ->subject($details['designation'] . ' Offer Letter');
            
            // Attach the uploaded offer letter if available
            if ($offerLetterPath) {
                $message->attach(storage_path('app/public/' . $offerLetterPath));
            }
        
            // Add BCC and CC if needed
        });
        
        

        return response()->json([
            'status' => 'success',
            'message' => 'Offer letter sent to the selected candidate',
            'data' => $applicants,
        ], 201);
    } catch (\Exception $e) {
        Log::error('Error in offerletter: ' . $e->getMessage());

        return response()->json([
            'status' => 'error',
            'message' => 'Something went wrong! Please try again. ' . $e->getMessage(),
        ], 500);
    }
}



}
