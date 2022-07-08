<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevMainController extends Controller
{
    public function index(Request $request)
    {
        return redirect('/developer/open-job');
    }

    public function openjob(Request $request)
    {
        return view ('developer.openjobs');
    }


}
