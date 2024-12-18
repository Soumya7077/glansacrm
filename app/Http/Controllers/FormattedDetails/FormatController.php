<?php

namespace App\Http\Controllers\FormattedDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FormatController extends Controller
{
    public function formattedDetails()
    {
        return view('screens.FormattedDetails.formattedDetails');
    }
    public function formattedapplicantslist()
    {
        return view('screens.FormattedDetails.formattedapplicantslist');
    }
    public function formattedapplicantstoemployer()
    {
        return view('screens.FormattedDetails.formattedapplicantstoemployer');
    }
}
