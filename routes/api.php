<?php

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

Route::get('/getuser/{id?}', [UserController::class, 'getuser']);
Route::post('/register', [UserController::class, 'store']);
Route::put('/update/{id}', [UserController::class, 'update']);
Route::delete('/delete/{id}', [UserController::class, 'delete']);
