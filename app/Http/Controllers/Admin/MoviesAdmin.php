<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperController;
use Illuminate\Http\Request;
use App\Http\Actions\MovieActions;
use App\Models\Movies;
use App\Models\Quotes;
use App\Models\Directors;
use Validator;

class MoviesAdmin extends HelperController
{
    public function Movies ()
    {
        return view('admin.movies.list');
    }

    public function MoviesJson (Request $request)
    {
        $actions = new MovieActions();
        return $actions->AllToJson();
    }

    public function AddMovie (Request $request)
    {
        $actions = new MovieActions();
        if($actions->inputsFail()) return pleaseFillAllFields();

        $actions->insertData();
        return insertSuccessResponse();
    }

    public function TheMovieJson (Request $request)
    {
        $id = (int)trim($request->get('id'));
        $movies = Movies::where('id', $id);

        if ($movies->count() == 0) return recordNotFoundResponse();

        return response()->json([
            'message' => __('main.record_found'),
            'status' => 1,
            'html' => view('admin.movies.edit', ['row' => $movies->first()])->render()
        ]);
    }

    public function EditMovie (Request $request, int $id)
    {
        $actions = new MovieActions();
        if($actions->inputsFail()) return pleaseFillAllFields();

        $check = Movies::where('id', $id);
        if($check->count() == 0) return recordNotFoundResponse();

        $actions->id($id)->update();

        return updateSuccessResponse();
    }

    public function SoftDelete (Request $request)
    {
        $movie_id = (int)trim($request->post('id'));
        $director = Movies::where('id', $movie_id);

        if($director->count() == 0) return recordNotFoundResponse();

        // მოვითხოვოთ ციტატების წაშლა სადაც რეჟისორი იგივეა
        Quotes::whereRaw('movie_id', $movie_id)->update(['deleted' => 1]);

        // წავშალოთ თავად ფილმი
        Movies::where('id', $movie_id)->update(['deleted' => 1]);

        return deleteSuccessResponse();
    }

}
