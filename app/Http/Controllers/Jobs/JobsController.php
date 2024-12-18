<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function joblist()
    {
        return view('screens.Jobs.joblist');
    }
    public function jobpost()
    {
        return view('screens.Jobs.jobpost');
    }
}
