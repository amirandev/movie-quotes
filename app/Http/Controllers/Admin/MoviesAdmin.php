<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperController;
use Illuminate\Http\Request;
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
        $sortCol = 'id';
        $sortOrder = 'desc';

        if (request()->get('sort') == 1) {
            $sortCol = 'id';
            $sortOrder = 'asc';
        }
        elseif (request()->get('sort') == 2) {
            $sortCol = 'id';
            $sortOrder = 'desc';
        }
        elseif (request()->get('sort') == 3) {
            $sortCol = 'title_en';
            $sortOrder = 'asc';
        }
        elseif (request()->get('sort') == 4) {
            $sortCol = 'title_en';
            $sortOrder = 'desc';
        }

        $search = trim($request->get('search'));

        $directors = Movies::where('deleted', 0)->where(function ($query) use ($search) {
            $query->where('title_en', 'like', "%{$search}%")->orWhere('title_ka', 'like', "%{$search}%");
        })
        ->orderBy($sortCol, $sortOrder)->paginate(3);

        $arrayData = $directors->toArray();

        return response()->json([
            'message' => 'Let\'s return the content',
            'html' => view('admin.movies.item', ['data' => $directors])->render(),
            'current_page' => $arrayData['current_page'],
            'next_page_url' => $arrayData['next_page_url'],
            'to' => $arrayData['to'],
            'total' => $arrayData['total']
        ]);
    }

    public function AddMovie (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|max:535',
            'title_ka' => 'required|max:535',
            'director' => 'required|numeric'
        ]);

        if ($validator->fails()) return pleaseFillAllFields();

        $image = $this->saveBase64($request->post('thumbnail'), 'movies');

        Movies::insert([
            'title_en' => trim($request->post('title_en')),
            'title_ka' => trim($request->post('title_ka')),
            'director_id' => trim($request->post('director')),
            'image' => trim($image),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return insertSuccessResponse();
    }

    public function TheMovieJson (Request $request)
    {
        $id = (int)trim($request->get('id'));
        $movies = Movies::where('id', $id);

        if ($movies->count() == 0) return recordNotFoundResponse();

        return response()->json([
            'message' => 'ჩანაწერი ნაპოვნია',
            'status' => 1,
            'html' => view('admin.movies.edit', ['row' => $movies->first()])->render()
        ]);
    }

    public function EditMovie (Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'title_en' => 'required|max:535',
            'title_ka' => 'required|max:535',
            'director' => 'required|numeric'
        ]);

        if ($validator->fails()) return pleaseFillAllFields();

        $check = Movies::where('id', $id);
        if($check->count() == 0) return recordNotFoundResponse();

        $postedImage = trim($request->post('thumbnail'));

        $values = [
            'title_en' => trim($request->post('title_en')),
            'title_ka' => trim($request->post('title_ka')),
            'director_id' => trim($request->post('director'))
        ];

        if(strlen($postedImage) > 24){
            $values['image'] = trim($this->saveBase64($postedImage, 'movies'));
        }

        Movies::where('id', $id)->update($values);

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
