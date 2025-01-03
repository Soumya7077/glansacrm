<?php

namespace App\Http\Controllers\SocialMedia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SmController extends Controller
{
    public function smform()
    {
        return view('screens.SocialMedia.socialMediaForm');
    }
    public function smlist()
    {
        return view('screens.SocialMedia.socialmedialist');
    }
}