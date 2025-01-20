<?php

use App\Http\Controllers\Applicants\ApplicantsApplyController;
use App\Http\Controllers\AssigningUser\AssigningUserController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Documents\DocumentsController;
use App\Http\Controllers\employer\EmployerController;
use App\Http\Controllers\Enquiry\EnquiryController;
use App\Http\Controllers\FormattedDetails\FormatController;
use App\Http\Controllers\Jobs\JobsController;
use App\Http\Controllers\OfferLetter\OfferController;
use App\Http\Controllers\role;
use App\Http\Controllers\ScheduleInterview\ScheduleInterview;
use App\Http\Controllers\SmConttroller;
use App\Http\Controllers\SocialMedia\SmController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\users\UserController;

// Main Page Route
Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard');

// User APIs
Route::get('/user', [UserController::class, 'index'])->name('User Creation');
Route::get('/userForm/{id?}', [UserController::class, 'userform'])->name('');
Route::post('/resetpassword', [UserController::class, 'emailpage'])->name('');
Route::get('/changepassword', [UserController::class, 'changepassview'])->name('');



Route::get('/joblist', [JobsController::class, 'joblist'])->name('Job List');
Route::get('/jobpost/{id?}', [JobsController::class, 'jobpost'])->name('jobpost');
Route::get('/jobs', [JobsController::class, 'jobs'])->name('Jobs');
Route::get('/applicantsapply', [ApplicantsApplyController::class, 'applicantsapply'])->name('Applicants Apply');
Route::get('/smapplicantslist', [ApplicantsApplyController::class, 'smapplicantslist'])->name('Assign Social Media Applicants');
Route::get('/socialMediaForm', [ApplicantsApplyController::class, 'socialMediaForm'])->name('social Media Form');
Route::get('/applicantlist', [ApplicantsApplyController::class, 'applicantlist'])->name('Applicant List');
Route::get('/assigninguser', [AssigningUserController::class, 'assigninguser'])->name('Assigning User');

Route::get('/employerlist', [EmployerController::class, 'index'])->name('Employer');
Route::get('/employer', [EmployerController::class, 'employerForm'])->name('Employer Form');

Route::get('/smform', [SmController::class, 'smform'])->name('socialmedia');
Route::get('/smlist', [SmController::class, 'smlist'])->name('socialmedialist');
Route::get('/formatdetails', [FormatController::class, 'formattedDetails'])->name('Formatted Details');
Route::get('/formattedapplicantslist', [FormatController::class, 'formattedapplicantslist'])->name('Formatted Applicants List');
Route::get('/formattedapplicantstoemployer', [FormatController::class, 'formattedapplicantstoemployer'])->name('Formatted Applicants to Employer');
Route::get('/offerletter', [OfferController::class, 'offer'])->name('Offer Letter');
Route::get('/documents', [DocumentsController::class, 'documents'])->name('Documents');
Route::get('/department  ', [DepartmentController::class, 'department'])->name('Department');


// authentication
Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
Route::get('/reset-password', [ForgotPasswordBasic::class, 'resetPassword'])->name('resetpassword');


// Enquiry APIs

Route::get('/enquiry', [EnquiryController::class, 'index'])->name('Enquiry');
Route::get('/enquiryForm', [EnquiryController::class, 'enquiryForm'])->name('Enquiry Form');


// get Role
Route::get('/roles', [role::class, 'index']);

Route::get('/schedule', [ScheduleInterview::class, 'scheduleInterview'])->name('Interview');
// Route::get('/schedule', [YourController::class, 'schedule'])->name('schedule');
