<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailController extends Controller
{
    public function create():View
    {
        return view('emails.create');
    }
    public function store(Request $request){

    }
}
