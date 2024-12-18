<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function documents()
    {
        return view('screens.Documents.documents');
    }
}
