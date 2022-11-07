<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function View($id, $title){
        return view('movie');
    }

    public function Movies ($id, $title){
        return view('moviesBy');
    }

    public function MoviesBy ($id, $title){
        return view('moviesBy');
    }

}
