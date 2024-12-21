<?php

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

/**===================================User API Start=============================================== */

Route::get('/getuser/{id?}', [UserController::class, 'getuser']);
Route::post('/register', [UserController::class, 'store']);
Route::put('/update/{id}', [UserController::class, 'update']);
Route::delete('/delete/{id}', [UserController::class, 'delete']);

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


