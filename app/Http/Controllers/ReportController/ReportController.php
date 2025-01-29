<?php

namespace App\Http\Controllers\ReportController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function joblistreport()
    {
        return view('screens.Reports.jobListReport');
    }
    public function applicantlistreport()
    {
        return view('screens.Reports.applicantsReport');
    }

    public function offerletterreport()
    {
        return view('screens.Reports.offerletterReport');
    }

    public function socialmediareport()
    {
        return view('screens.Reports.socialmediaReport');
    }

    public function selectedreport()
    {
        return view('screens.Reports.selectedReport');
    }

    public function rejectedreport()
    {
        return view('screens.Reports.rejectedReport');
    }
}
