<?php

namespace App\Http\Controllers\employer;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
  public function index()
  {
    return view('screens.employer.employer-list');
  }

  public function employerForm()
  {
    return view('screens.employer.employer-form');
  }


  // employer create

  public function createEmployer()
  {
    try{
      $employer = 
    }catch(Exception $e){
      return $e;
    }
  }


}
