<?php

use App\Http\Controllers\employer\EmployerController;
use App\Http\Controllers\Jobs\JobsController;
use App\Http\Controllers\SmConttroller;
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

Route::get('/employer', [EmployerController::class, 'index'])->name('employer');





// authentication
Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
