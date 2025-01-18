<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class Analytics extends Controller
{
  public function index()
  {
  $token=Session::get('token');

    return view('content.dashboard.dashboards-analytics',compact('token'));
  }
}
