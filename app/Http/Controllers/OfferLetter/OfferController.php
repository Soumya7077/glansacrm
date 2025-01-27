<?php

namespace App\Http\Controllers\OfferLetter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function offer()
    {
        return view('screens.OfferLetter.offerLetter');
    }

    public function offerletter()
    {
        
    }
}
