<?php

namespace App\Http\Controllers\Applicants;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicantsApplyController extends Controller
{
    public function applicantsapply()
    {
        return view('screens.Applicants.applicantsapply');
    }
    public function smapplicantslist()
    {
        return view('screens.Applicants.smapplicantslist');
    }
    public function applicantlist()
    {
        return view('screens.Applicants.applicantlist');
    }

}
