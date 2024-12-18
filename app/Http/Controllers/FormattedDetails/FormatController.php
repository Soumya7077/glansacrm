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
}
