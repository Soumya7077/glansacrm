<?php

use App\Http\Controllers\Applicants\ApplicantsApplyController;
use App\Http\Controllers\AssigningUser\AssigningUserController;
use App\Http\Controllers\authentications\AuthController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\employer\EmployerController;
use App\Http\Controllers\Jobs\JobsController;
use App\Http\Controllers\users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

/**===================================Login API Start=============================================== */

// Login route
// Route::post('/login', [AuthController::class, 'login'])->name('login');

// // Dashboard route
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');


/**===================================User API End=============================================== */

/**===================================User API Start=============================================== */

Route::get('/getuser/{id?}', [UserController::class, 'getuser']);
// Route::post('/register', [UserController::class, 'store']);
Route::post('/users', [UserController::class, 'store'])->name('user.store');
Route::put('/update/{id}', [UserController::class, 'update']);
Route::delete('/delete/{id}', [UserController::class, 'delete']);
Route::get('/getrecruiter', [UserController::class, 'getRecruiter']);

/**===================================User API End=============================================== */



/**===================================Employer API Start=============================================== */

Route::post('/createEmployer', [EmployerController::class, 'createEmployer']);
Route::get('/getEmployer', [EmployerController::class, 'getAllEmployees']);
Route::get('/getEmployer/{id}', [EmployerController::class, 'getEmployerById']);
Route::put('/updateEmployer/{id}', [EmployerController::class, 'UpdateEmployer']);
Route::delete('/deleteEmployer/{id}', [EmployerController::class, 'deleteEmployer']);

/**===================================Employer API End=============================================== */


/**===================================Jobs API Start=============================================== */

Route::post('/createJob', [JobsController::class, 'createJob']);
Route::get('/getJob', [JobsController::class, 'getAllJobs']);
Route::get('/getJob/{id}', [JobsController::class, 'getJobsById']);
Route::put('/updateJob/{id}', [JobsController::class, 'updateJobs']);
Route::delete('/deleteJob/{id}', [JobsController::class, 'deleteJobs']);

/**===================================Jobs API End=============================================== */


/**==================================Assign recruiter to job======================================== */

Route::get('/getassignedrecruiter', [AssigningUserController::class, 'getAssignedRecruiter']);
Route::post('/assignrecruitertojob', [AssigningUserController::class, 'assignRecruiterToJob']);
Route::get('/getassignedrecruiter/{id}', [AssigningUserController::class, 'getAssignedRecruiterById']);
Route::put('/updateassignuser/{id}', [AssigningUserController::class, 'updateAssignUser']);
Route::put('/deleteassignuser/{id}', [AssigningUserController::class, 'deleteAssignUser']);


/**==================================Assign recruiter to job======================================== */

/**===================================Applicant API Start=============================================== */

Route::post('/applicant', [ApplicantsApplyController::class, 'createApplicant']);
Route::get('/getapplicant', [ApplicantsApplyController::class, 'getApplicant']);
Route::get('/getapplicant/{id}', [ApplicantsApplyController::class, 'getApplicantById']);
Route::put('/updateApplicant/{id}', [ApplicantsApplyController::class, 'updateApplicant']);
Route::delete('/deleteApplicant/{id}', [ApplicantsApplyController::class, 'deleteApplicant']);

/**===================================Applicant API End=============================================== */


/**===================================Department API Start=============================================== */

Route::get('/getdepartment{id?}', [DepartmentController::class, 'index']);
Route::post('/department', [DepartmentController::class, 'store']);
Route::put('/updateDepartment/{id}', [DepartmentController::class, 'update']);
Route::delete('/deleteDepartment/{id}', [DepartmentController::class, 'destroy']);

/**===================================Department API End=============================================== */


/**==================================Assign recruiter to job======================================== */

Route::get('/getassignedrecruiter', [AssigningUserController::class, 'getAssignedRecruiter']);
Route::post('/assignrecruitertojob', [AssigningUserController::class, 'assignRecruiterToJob']);
Route::get('/getassignedrecruiter/{id}', [AssigningUserController::class, 'getAssignedRecruiterById']);
Route::put('/updateassignuser/{id}', [AssigningUserController::class, 'updateAssignUser']);
Route::delete('/deleteassignuser/{id}', [AssigningUserController::class, 'deleteAssignUser']);


/**==================================Assign recruiter to job======================================== */


Route::post('/login', [UserController::class, 'login']);


// Route::group([

//   'middleware' => 'api',
//   'prefix' => 'auth'

// ], function ($router) {

//   Route::post('login', 'UserController@login');
//   // Route::post('logout', 'AuthController@logout');
//   // Route::post('refresh', 'AuthController@refresh');
//   // Route::post('me', 'AuthController@me');

// });
