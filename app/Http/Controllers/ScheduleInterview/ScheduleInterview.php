<?php

namespace App\Http\Controllers\ScheduleInterview;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleInterview extends Controller
{
    public function scheduleInterview()
    {
        return view('screens.ScheduleInterview.scheduleInterview');
    }
}
