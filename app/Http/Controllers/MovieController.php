<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Directors;
use App\Models\Movies;

class MovieController extends Controller
{
    public function Movies (){
        return view('pages.movies.movies');
    }

    public function ViewMovie(int $id, string $title){

        $movie = Movies::where('id', $id);
        if($movie->count() == 0) return redirect()->route('movies');
        return view('pages.movies.movie', ['movie' => $movie->first()]);
    }

    public function MoviesBy (int $id, string $title){
        $director = Directors::where('id', $id);
        if($director->count() == 0) return redirect()->route('directors');

        return view('pages.movies.moviesBy', ['director' => $director->first()]);
    }

}
