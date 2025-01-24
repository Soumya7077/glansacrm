<?php

namespace App\Http\Controllers\ScheduleInterview;

use App\Http\Controllers\Controller;
use App\Models\ApplicantModel;
use App\Models\JobPostModel;
use App\Models\ScheduleInterviewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ScheduleInterview extends Controller
{
    public function scheduleInterview()
    {
        return view('screens.ScheduleInterview.scheduleInterview');
    }

    public function scheduleInterviewCandidate()
    {
        return view('screens.ScheduleInterview.scheduleInterview-candidate');
    }

    public function getAllInterviews()
    {
        try {
            // Fetch all records from ScheduleInterviewModel
            $interviews = ScheduleInterviewModel::all();

            // Return a success response with the data
            return response()->json([
                'success' => true,
                'message' => 'Interview schedules retrieved successfully.',
                'data' => $interviews,
            ], 200);
        } catch (\Exception $e) {
            // Handle any errors
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve interview schedules. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function sendInterviewEmail(Request $request)
    {
        try {
            // Validate incoming request
            $request->validate([
                'EmployerId' => 'required|integer',
                'ApplicantId' => 'required|integer',
                'JobId' => 'required|integer',
                'Type' => 'required|string',
                'Link/Location' => 'required|string',
                'InterviewDate' => 'required|date',
                'ApplicantEmail' => 'required|email',
                'BCC' => 'nullable|email', // Optional BCC field
                'CC' => 'nullable|email',  // Optional CC field
                'Description' => 'required|string',
                'FirstTimeSlot' => 'required|string',
                'SecondTimeSlot' => 'nullable|string', // Optional Second Time Slot
                'ThirdTimeSlot' => 'nullable|string',  // Optional Third Time Slot
                'Status' => 'required|integer',
                'CreatedBy' => 'required|integer',
            ]);

            // Check for duplicate applicantId and jobId
            $existingInterview = ScheduleInterviewModel::where('ApplicantId', $request->input('ApplicantId'))
                ->where('JobId', $request->input('JobId'))
                ->first();

            if ($existingInterview) {
                return response()->json(['message' => 'An interview for this applicant and job already exists.'], 400);
            }

            // Retrieve the data from the request
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

            // Add creation and update timestamps
            $data['CreatedOn'] = now();
            $data['UpdatedOn'] = now();
            $data['UpdatedBy'] = $data['CreatedBy'];

            // Get the applicant's email and name
            $applicantEmail = $request->input('ApplicantEmail');
            $applicant = ApplicantModel::find($data['ApplicantId']);
            $applicantName = $applicant ? $applicant->FirstName : 'Applicant';

            // Retrieve the job title based on JobId from the JobPostModel
            $job = JobPostModel::find($data['JobId']);
            $jobTitle = $job ? $job->Title : 'Job Post';

            // Log the data for debugging
            Log::info('Interview Data:', ['data' => $data]);
            Log::info('Job Title:', ['jobTitle' => $jobTitle]);

            // Prepare time slots
            $timeSlots = [
                'FirstTimeSlot' => $data['FirstTimeSlot'],
                'SecondTimeSlot' => $data['SecondTimeSlot'] ?? null,
                'ThirdTimeSlot' => $data['ThirdTimeSlot'] ?? null,
            ];

            // Send email with the interview details
            Mail::send('email.interview_schedule', [
                'ApplicantName' => $applicantName,
                'InterviewDate' => $data['InterviewDate'],
                'TimeSlots' => $timeSlots,
                'Type' => $data['Type'],
                'Link' => $data['Link/Location'],
                'Description' => $data['Description'],
                'JobTitle' => $jobTitle,
            ], function ($message) use ($applicantEmail, $data) {
                $message->to($applicantEmail);

                // Add BCC and CC if provided
                if (!empty($data['BCC'])) {
                    $message->bcc($data['BCC']);
                }

                if (!empty($data['CC'])) {
                    $message->cc($data['CC']);
                }

                $message->subject('Interview Invitation');
            });

            // Save the interview schedule to the database
            ScheduleInterviewModel::create($data);

            // Return the success response
            return response()->json(['message' => 'Email sent and interview scheduled successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error during interview email send: ' . $e->getMessage());
            return response()->json(['message' => 'Error sending interview email. Please try again later.'], 500);
        }
    }




    public function updateInterviewDetails(Request $request, $id)
    {
        try {
            // Validate incoming request
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

            // Retrieve the existing interview by id
            $interview = ScheduleInterviewModel::find($id);

            // Check if the interview exists
            if (!$interview) {
                return response()->json(['message' => 'Interview not found'], 404);
            }

            // Retrieve the updated data from the request
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

            // Add timestamps
            $data['UpdatedOn'] = now();
            $data['UpdatedBy'] = $data['CreatedBy']; // Assuming you want to track who updated the interview

            // Update the interview with the new data
            $interview->update($data);

            // Get the applicant's email and name (if needed)
            $applicant = ApplicantModel::find($data['ApplicantId']);
            $applicantName = $applicant ? $applicant->FirstName : 'Applicant';

            // Retrieve the job title based on JobId from the JobPostModel
            $job = JobPostModel::find($data['JobId']);
            $jobTitle = $job ? $job->Title : 'Job Post';

            // Send updated email with the interview details
            Mail::send('email.interview_schedule', [
                'ApplicantName' => $applicantName,
                'InterviewDate' => $data['InterviewDate'],
                'FirstTimeSlot' => $data['FirstTimeSlot'],
                'SecondTimeSlot' => $data['SecondTimeSlot'],
                'ThirdTimeSlot' => $data['ThirdTimeSlot'],
                'Type' => $data['Type'],
                'Link' => $data['Link/Location'],
                'Description' => $data['Description'],
                'JobTitle' => $jobTitle,
            ], function ($message) use ($data) {
                $message->to($data['ApplicantEmail'])
                    ->bcc($data['BCC'] ?? null)
                    ->cc($data['CC'] ?? null)
                    ->subject('Updated Interview Invitation');
            });

            // Return the success response
            return response()->json(['message' => 'Interview details updated and email sent successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error during interview update: ' . $e->getMessage());
            return response()->json(['message' => 'Error updating interview details. Please try again later.'], 500);
        }
    }

    public function getInterviewForEdit($id)
    {
        try {
            // Retrieve the interview data by ID
            $interview = ScheduleInterviewModel::find($id);

            if (!$interview) {
                return response()->json(['message' => 'Interview not found'], 404);
            }

            // Return the interview data as response for editing
            return response()->json(['data' => $interview], 200);

        } catch (\Exception $e) {
            // Log error if something goes wrong
            Log::error('Error fetching interview for edit: ' . $e->getMessage());
            return response()->json(['message' => 'Error fetching interview data. Please try again later.'], 500);
        }
    }




}
