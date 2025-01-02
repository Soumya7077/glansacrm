<?php

namespace App\Http\Controllers\Enquiry;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        return view('screens.Enquiry.enquiry');
    }
    public function enquiryForm()
    {
        return view('screens.Enquiry.enquiryForm');
    }
}
