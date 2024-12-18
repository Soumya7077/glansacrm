<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SmConttroller extends Controller
{
    public function smform()
    {
        return view('screens.SocialMedia.socialMediaForm');
    }
}
