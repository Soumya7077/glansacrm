<?php

namespace App\Http\Controllers\ScheduleInterview;

use App\Http\Controllers\Controller;
use App\Models\ApplicantModel;
use App\Models\ScheduleInterviewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ScheduleInterview extends Controller
{
    public function scheduleInterview()
    {
        return view('screens.ScheduleInterview.scheduleInterview');
    }    
    public function sendInterviewEmail(Request $request)
{
    $request->validate([
        'EmployerId' => 'required|integer',
        'ApplicantId' => 'required|integer',
        'JobId' => 'required|integer',
        'Type' => 'required|string',
        'Link/Location' => 'required|string',
        'InterviewDate' => 'required|date',
        'ApplicantEmail' => 'required|email',
        'BCC' => 'nullable|email',
        'CC' => 'nullable|email',
        'Description' => 'required|string',
        'FirstTimeSlot' => 'required|string',
        'SecondTimeSlot' => 'nullable|string',
        'ThirdTimeSlot' => 'nullable|string',
        'Status' => 'required|integer',
        'CreatedBy' => 'required|integer',
    ]);

    $data = $request->only([
        'EmployerId',
        'ApplicantId',
        'JobId',
        'Type',
        'Link/Location',
        'InterviewDate',
        'BCC',
        'CC',
        'Description',
        'FirstTimeSlot',
        'SecondTimeSlot',
        'ThirdTimeSlot',
        'Status',
        'CreatedBy',
    ]);

    $data['CreatedOn'] = now();
    $data['UpdatedOn'] = now();
    $data['UpdatedBy'] = $data['CreatedBy'];

    $applicantEmail = $request->input('ApplicantEmail');
    $applicant = ApplicantModel::find($data['ApplicantId']);
    $applicantName = $applicant ? $applicant->FirstName : 'Applicant';

    // Send email
    Mail::send('email.interview_schedule', [
        'ApplicantName' => $applicantName,
        'InterviewDate' => $data['InterviewDate'],
        'FirstTimeSlot' => $data['FirstTimeSlot'],
        'SecondTimeSlot' => $data['SecondTimeSlot'],
        'ThirdTimeSlot' => $data['ThirdTimeSlot'],
        'Type' => $data['Type'],
        'Link' => $data['Link/Location'],
        'Description' => $data['Description'],
    ], function ($message) use ($applicantEmail, $data) {
        $message->to($applicantEmail)
                ->bcc($data['BCC'] ?? null)
                ->cc($data['CC'] ?? null)
                ->subject('Interview Invitation');
    });

    // Save the interview schedule to the database
    ScheduleInterviewModel::create($data);

    return response()->json(['message' => 'Email sent and interview scheduled successfully'], 200);
}

   
}
