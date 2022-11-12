<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Directors;
use App\Models\Quotes;

class MainController extends Controller
{
    public function index(){
        $quote = Quotes::inRandomOrder()->limit(1)->first();
        return view('index', compact('quote'));
    }

    public function Quotes ()
    {
        return view('pages.quotes.quotes');
    }

    public function Directors ()
    {
        return view('pages.directors.directors');
    }

    public function TopDirectors ()
    {
        $directors = Directors::select('directors.*', DB::raw('(SELECT COUNT(quotes.id) FROM quotes WHERE quotes.movie_id IN (SELECT movie_id FROM movies WHERE movies.director_id = directors.id)) AS total_quotes'))
        ->orderByRaw('total_quotes DESC')->limit(3)->get();

        return view('pages.directors.topdirectors', compact('directors'));
    }


}
