<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use App\Models\JobPostModel;
use Exception;
use Illuminate\Http\Request;

class JobsController extends Controller
{
  public function joblist()
  {
    return view('screens.Jobs.joblist');
  }

  // public function editJob($id)
  // {
  //   $job = Job::find($id);
  //   if ($job) {
  //     return view('jobpost', compact('job'));
  //   } else {
  //     return redirect('/joblist')->with('error', 'Job not found');
  //   }
  // }


  public function jobs()
  {
    // return view('screens.Jobs.jobpost');
    $jobs = [
      [
        'id' => 1,
        'title' => 'Medical Assistant',
        'company' => 'CyberPoint Pvt. Ltd',
        'location' => 'Gurugram, Haryana',
        'salary' => '₹45,000 - ₹60,000 a month',
        'type' => 'Full-time',
        'schedule' => 'Monday to Friday',
      ],
      [
        'id' => 2,
        'title' => 'Medical Assistant',
        'company' => 'CyberPoint Pvt. Ltd',
        'location' => 'Gurugram, Haryana',
        'salary' => '₹45,000 - ₹60,000 a month',
        'type' => 'Full-time',
        'schedule' => 'Monday to Friday',
      ],
      [
        'id' => 3,
        'title' => 'Medical Assistant',
        'company' => 'CyberPoint Pvt. Ltd',
        'location' => 'Gurugram, Haryana',
        'salary' => '₹45,000 - ₹60,000 a month',
        'type' => 'Full-time',
        'schedule' => 'Monday to Friday',
      ],
      [
        'id' => 4,
        'title' => 'Medical Assistant',
        'company' => 'CyberPoint Pvt. Ltd',
        'location' => 'Gurugram, Haryana',
        'salary' => '₹45,000 - ₹60,000 a month',
        'type' => 'Full-time',
        'schedule' => 'Monday to Friday',
      ],
    ];
    return view('screens.Jobs.jobs', compact('jobs'));
  }




  public function jobpost($id = null)
  {
    if ($id) {
      $job = JobPostModel::find($id);
      if ($job) {
        return view('screens.Jobs.jobpost', compact('job'));
      } else {
        return view('screens.Jobs.jobpost');
      }
    } else {
      return view('screens.Jobs.jobpost');
    }
  }

  public function createJob(Request $request)
  {
    // \Log::info('Incoming Request:', $request->all());
    try {
      // Create the job post
      $jobPost = JobPostModel::create([
        'EmployerId' => $request->EmployerId,
        'Title' => $request->Title,
        'Description' => $request->Description,
        'Opening' => $request->Opening,
        'MaxSalary' => $request->MaxSalary,
        'MinSalary' => $request->MinSalary,
        'JobsLocation' => $request->JobsLocation,
        'Education' => $request->Education,
        'KeySkills' => $request->KeySkills,
        'MaxExperience' => $request->MaxExperience,
        'MinExperience' => $request->MinExperience,
        'Department' => $request->DepartmentId,
        'Shift' => $request->Shift,
        'Month/Year' => $request->MonthYear,
        'EmploymentType' => $request->EmploymentType,
        'Timeline' => $request->Timeline,
        'Location' => $request->Location,
        'Benefits' => $request->Benefits,
        'Gender' => $request->Gender,
        'Remarks' => $request->Remarks,
        'CreatedOn' => now(),
        'CreatedBy' => $request->CreatedBy,
        'ModifyOn' => now(), // Set the current timestamp
        'ModifyBy' => $request->ModifyBy ?? null,
      ]);

      // Return a successful response
      return response()->json([
        'status' => 'success',
        'message' => 'Job post created successfully!',
        'data' => $jobPost
      ], 201);
    } catch (Exception $e) {
      // Handle exceptions
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  // Get all Jobs list

  public function getAllJobs()
  {
    try {
      $jobs = JobPostModel::all();

      if ($jobs) {
        return response()->json([
          'status' => 'success',
          'message' => 'Jobs List Fetch successfully!',
          'data' => $jobs
        ], 200);
      } else {
        return response()->json([
          'status' => 'error',
          'message' => 'No data found!',
          'data' => $jobs
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

  public function getJobsById($id)
  {
    try {
      if ($id) {
        $jobs = JobPostModel::find($id);
        if ($jobs) {
          return response()->json([
            'status' => 'success',
            'message' => 'Jobs fetch by id successful',
            'data' => $jobs,
          ], 200);
        } else {
          return response()->json([
            'status' => 'error',
            'message' => 'Data not found',
            'data' => $jobs,
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


  // Update Employer list by id

  public function updateJobs(Request $request, $id)
  {
    try {
      // Find the job post by ID
      $jobPost = JobPostModel::findOrFail($id);

      // Update the job post
      $jobPost->update([
        'EmployerId' => $request->EmployerId,
        'Title' => $request->Title,
        'Description' => $request->Description,
        'Opening' => $request->Opening,
        'MaxSalary' => $request->MaxSalary,
        'MinSalary' => $request->MinSalary,
        'JobsLocation' => $request->JobsLocation,
        'Education' => $request->Education,
        'KeySkills' => $request->KeySkills,
        'MaxExperience' => $request->MaxExperience,
        'MinExperience' => $request->MinExperience,
        'Department' => $request->DepartmentId,
        'Shift' => $request->Shift,
        'Month/Year' => $request->MonthYear,
        'EmploymentType' => $request->EmploymentType,
        'Timeline' => $request->Timeline,
        'Location' => $request->Location,
        'Benefits' => $request->Benefits,
        'Gender' => $request->Gender,
        'Remarks' => $request->Remarks,
        'ModifyOn' => now(), // Set the current timestamp
        'ModifyBy' => $request->ModifyBy ?? null,
      ]);

      // Return a successful response
      return response()->json([
        'status' => 'success',
        'message' => 'Job post updated successfully!',
        'data' => $jobPost
      ], 200);
    } catch (Exception $e) {
      // Handle exceptions
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }

  // Delete employer

  public function deleteJobs($id)
  {
    try {
      $job = JobPostModel::find($id);
      if (!$job) {
        return response()->json(['error' => 'Jobs not found'], 404);
      } else {
        $job->delete();
        return response()->json([
          'Status' => 'success',
          'message' => 'Job Deleted Successfully'
        ], 200);
      }


    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }

}
