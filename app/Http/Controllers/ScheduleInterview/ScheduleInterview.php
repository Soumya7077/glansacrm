<?php

namespace App\Http\Controllers\ScheduleInterview;

use App\Http\Controllers\Controller;
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
    // Validate incoming request
    $request->validate([
        'candidate.email' => 'required|email', // Validate candidate's email
        'candidate.name' => 'required|string', // Validate candidate's name
        'interviewDate' => 'required|date', // Validate interview date
        'timeSlots' => 'required|array|min:1', // Ensure time slots are provided
        'mode' => 'required|string', // Validate interview mode (e.g., 'Virtual' or 'Walk-in')
        'bcc' => 'nullable|email', // Validate BCC email
        'cc' => 'nullable|email', // Validate CC email
        'description' => 'required|string', // Validate description
        'location' => 'required|string', // Validate location/virtual link
    ]);

    $candidate = $request->input('candidate');
    $interviewDate = $request->input('interviewDate');
    $timeSlots = $request->input('timeSlots');
    $mode = $request->input('mode');
    $bcc = $request->input('bcc');
    $cc = $request->input('cc'); // Fetch CC email
    $description = $request->input('description');
    $location = $request->input('location');

    // Send email to the candidate
    Mail::send('email.interview_schedule', [
        'name' => $candidate['name'],
        'interviewDate' => $interviewDate,
        'timeSlots' => $timeSlots,
        'mode' => $mode,
        'description' => $description,
        'location' => $location,
    ], function ($message) use ($candidate, $bcc, $cc) {
        $message->to($candidate['email'], $candidate['name'])
            ->subject('Interview Invitation');

        if ($bcc) {
            $message->bcc($bcc); // Add BCC email if provided
        }

        if ($cc) {
            $message->cc($cc); // Add CC email if provided
        }
    });

    return response()->json(['message' => 'Email sent successfully'], 200);
}

    
}
