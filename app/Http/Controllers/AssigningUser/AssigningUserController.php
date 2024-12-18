<?php

namespace App\Http\Controllers\AssigningUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssigningUserController extends Controller
{
    public function assigninguser()
    {
        return view('screens.assigninguser.assigninguser');
    }


}
