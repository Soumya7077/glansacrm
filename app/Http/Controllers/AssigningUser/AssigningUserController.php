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

      $getRecruiter = RecruiterAssignsModel::where('JobId', '=', $request->jobId)->first();

      if ($getRecruiter) {
        return response()->json([
          'status' => 'error',
          'message' => 'This job already assign to one recruiter',
        ], 409);
      }


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

  public function getAssignedRecruiter($id)
  {
    try {
      $assignedRecruiter = DB::table('recruiter_assign')
        ->join('job_post', 'job_post.id', '=', 'recruiter_assign.JobId')
        ->join('user', 'user.id', '=', 'recruiter_assign.UserId')
        ->join('employees', 'job_post.EmployerId', '=', 'employees.id') // Fixed this line
        ->join('departments', 'departments.id', '=', 'job_post.Department')
        ->where('recruiter_assign.UserId', '=', $id)
        ->select('recruiter_assign.*', 'job_post.*', 'user.*', 'employees.OrganizationName', 'departments.Name as DepartmentName')
        ->get();

      if ($assignedRecruiter) {
        return response()->json([
          'status' => 'success',
          'message' => 'Get Assigned Recruiter',
          'data' => $assignedRecruiter,
        ], 200);
      }
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong, ' . $e->getMessage(),
      ], 500);
    }

  }

  /**=============================Get assigned recruiter=====================================*/



  /**============================Get assigned user by id=================================== */

  public function getAssignedRecruiterById($id)
  {
    try {
      $assignedRecruiter = RecruiterAssignsModel::find($id);
      if ($assignedRecruiter) {
        return response()->json([
          'status' => 'success',
          'message' => 'Assign recruiter fetch successfully',
          'data' => $assignedRecruiter
        ], 200);
      } else {
        return response()->json([
          'status' => 'error',
          'message' => 'Can not find the assign recruiter with this id',
          'data' => $assignedRecruiter
        ], 400);
      }
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong, ' . $e->getMessage(),
      ], 500);
    }
  }

  /**============================Get assigned user by id=================================== */


  /**==============================Update assigned user by id============================== */


  public function updateAssignUser(Request $request, $id)
  {
    try {
      $assignUser = RecruiterAssignsModel::find($id);

      if (!$assignUser) {
        return response()->json(['error' => 'Data not found'], 404);
      }

      $assignUser->JobId = $request->jobId;
      $assignUser->UserId = $request->userId;
      $assignUser->UpdatedBy = $request->updatedBy;
      $assignUser->UpdatedOn = now();
      $assignUser->updated_at = now();

      $assignUser->save();

      return response()->json(['message' => 'Recruiter assign updated successfully', 'data' => $assignUser], 200);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong, ' . $e->getMessage(),
      ], 500);
    }
  }


  /**==============================Update assigned user by id============================== */


  /**===============================Delete assigned user by id================================= */

  public function deleteAssignUser($id)
  {
    try {
      $assignRecruiter = RecruiterAssignsModel::find($id);
      if (!$assignRecruiter) {
        return response()->json(['error' => 'Data not found'], 404);
      }
      $assignRecruiter->delete();
      return response()->json(['message' => 'Assign Recruiter deleted successfully'], 200);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'message' => 'Something went wrong, ' . $e->getMessage(),
      ], 500);
    }
  }


  /**===============================Delete assigned user by id================================= */






}
