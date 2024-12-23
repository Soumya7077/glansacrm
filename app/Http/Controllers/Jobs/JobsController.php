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


  public function jobpost()
  {
    return view('screens.Jobs.jobpost');
  }

  public function createJob(Request $request)
  {
    \Log::info('Incoming Request:', $request->all());
    try {
      // Create the job post
      $jobPost = JobPostModel::create([
        'EmployerId' => $request->EmployerId,
        'Title' => $request->Title,
        'Organisation' => $request->OrganisationName,
        'Description' => $request->Description,
        'CreatedOn' => now(),
        'CreatedBy' => $request->CreatedBy,
        'ModifyOn' => now(), // Set the current timestamp
        'ModifyBy' => $request->ModifyBy ?? null,
        'Opening' => $request->Opening,
        'Salary' => $request->Salary,
        'Location' => $request->Location,
        'Education' => $request->Education,
        'KeySkills' => $request->KeySkills,
        'Department' => $request->Department,
        'Experience' => $request->Experience,
        'Shift' => $request->Shift,
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
        'EmployerId' => $request->EmployerId ?? $jobPost->EmployerId,
        'Title' => $request->Title ?? $jobPost->Title,
        'Description' => $request->Description ?? $jobPost->Description,
        'Opening' => $request->Opening ?? $jobPost->Opening,
        'Salary' => $request->Salary ?? $jobPost->Salary,
        'Location' => $request->Location ?? $jobPost->Location,
        'Education' => $request->Education ?? $jobPost->Education,
        'KeySkills' => $request->KeySkills ?? $jobPost->KeySkills,
        'Department' => $request->Department ?? $jobPost->Department,
        'Experience' => $request->Experience ?? $jobPost->Experience,
        'Shift' => $request->Shift ?? $jobPost->Shift,
        'ModifyOn' => now(),
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
        return response()->json(['error' => 'Jons not found'], 404);
      }
      $job->delete();
      return response()->json(['message' => 'Jobs deleted successfully'], 200);

    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong! Please try again.',
        'error' => $e->getMessage()
      ], 500);
    }
  }

}
