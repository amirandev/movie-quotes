<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectorsController extends Controller
{
    public function Directors ()
    {
        return view('directors');
    }

    public function TopDirectors ()
    {
        return view('topdirectors');
    }

}
