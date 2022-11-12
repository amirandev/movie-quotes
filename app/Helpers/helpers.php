<?php
use App\Models\Directors;
use App\Models\Movies;
use App\Models\Quotes;

function stats(string $out){
    if($out == 'directors'){
        return Directors::count();
    }
    elseif($out == 'movies'){
        return Movies::count();
    }
    elseif($out == 'quotes'){
        return Quotes::count();
    }
}

function isLang($lang){
    return session()->get('lang') == $lang ? true : false;
}

function thisroute($what=null){
    if($what=="prefix"){
        $namePrefix = \Route::current()->action['prefix'];
        return $namePrefix;
    }
    return Route::currentRouteName();
}

function routeActive(string $route_name, string $Whatever = 'active'){
    return thisroute() == $route_name ? $Whatever : 'notactive';
}

function randomString($n){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}

function allDirectors(){
    return Directors::orderBy('name_en', 'asc')->orderBy('name_ka', 'asc');
}

function allMovies(){
    return Movies::orderBy('title_en', 'asc')->orderBy('title_ka', 'asc');
}

function movie_info(int $id, $out){

    $movie = Movies::where('id', $id);
    if($movie->count() == 0) return false;

    $movie = $movie->first();

    if($out == 'director'){
        return Directors::where('id', $movie->director_id)->first();
    }

    return $movie;
}


function director_info(int $id, $out){

    $director = Directors::where('id', $id);
    if($director->count() == 0) return false;

    $director = $director->first();

    if($out == 'quotes'){
        return Quotes::select('quotes.*')->whereRaw('quotes.movie_id IN (SELECT movies.id FROM movies WHERE movies.director_id = '.$id.')')->get();
    }

    return $director;
}

function insertSuccessResponse(){
    return response()->json([
        'message' => __('main.record_insertd'),
        'status' => 1
    ]);
}

function updateSuccessResponse(){
    return response()->json([
        'message' => __('main.record_updated'),
        'status' => 1
    ]);
}

function recordNotFoundResponse(){
    return response()->json([
        'message' => __('main.recordNotFound'),
        'status' => 0
    ]);
}

function deleteSuccessResponse(){
    return response()->json([
        'message' => __('main.record_deleted'),
        'status' => 1
    ]);
}

function pleaseFillAllFields(){
    return response()->json([
        'message' => __('main.pleaseFillTheFields'),
        'status' => 0
    ]);
}

