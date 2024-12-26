<?php

namespace App\Http\Controllers\AssigningUser;

use App\Http\Controllers\Controller;
use App\Models\RecruiterAssignsModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssigningUserController extends Controller
{
  public function assigninguser()
  {
    return view('screens.assigninguser.assigninguser');
  }


  /** ==============================Assigning particular recruiter to a job=========================== */

  public function assignRecruiterToJob(Request $request)
  {
    try {

      $assignRecruiter = RecruiterAssignsModel::create([
        'JobId' => $request->jobId,
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

  /** ==============================Assigning particular recruiter to a job=========================== */


  /**=============================Get assigned recruiter=====================================*/

  public function getAssignedRecruiter()
  {
    $assignedRecruiter = DB::table('recruiter_assign')
      ->join('job_post', 'job_post.id', '=', 'recruiter_assign.JobId')
      ->join('user', 'user.id', '=', 'recruiter_assign.UserId')
      ->select('recruiter_assign.*', 'job_post.Title', 'user.Name')
      ->get();
    return $assignedRecruiter;
  }

  /**=============================Get assigned recruiter=====================================*/


}
