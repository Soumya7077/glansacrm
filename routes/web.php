<?php

use App\Http\Controllers\Applicants\ApplicantsApplyController;
use App\Http\Controllers\employer\EmployerController;
use App\Http\Controllers\Enquiry\EnquiryController;
use App\Http\Controllers\Jobs\JobsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;

use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\users\UserController;

// Main Page Route
Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
Route::get('/user', [UserController::class, 'index']);
Route::get('/userForm', [UserController::class, 'userform']);


Route::get('/joblist', [JobsController::class, 'joblist'])->name('joblist');
Route::get('/jobpost', [JobsController::class, 'jobpost'])->name('jobpost');
Route::get('/applicantsapply', [ApplicantsApplyController::class, 'applicantsapply'])->name('applicantsapply');
Route::get('/smapplicantslist', [ApplicantsApplyController::class, 'smapplicantslist'])->name('smapplicantslist');

Route::get('/employer', [EmployerController::class, 'index'])->name('employer');





// authentication
Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');


// Enquiry APIs

Route::get('enquiry',[EnquiryController::class,'index']);
