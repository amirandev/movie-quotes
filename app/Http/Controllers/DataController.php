<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotes;
use App\Models\Movies;
use App\Models\Directors;

class DataController extends Controller
{
    public function Quotes (Request $request)
    {
        $sortOrder = request()->get('sort') == 1 ? 'asc' : 'desc';
        $search = trim($request->get('search'));
        $movie_id = (int)trim($request->get('movie'));

        $where = [
            ['deleted', '=', 0]
        ];

        if($movie_id > 0){
            $where[] = ['id', '=', $movie_id];
        }

        $quotes = Quotes::where($where)->where(function ($query) use ($search) {
            $query->where('text_en', 'like', "%{$search}%")->orWhere('text_ka', 'like', "%{$search}%");
        })
        ->orderBy('id', $sortOrder)->paginate(4);
        $arrayData = $quotes->toArray();

        return response()->json([
            'message' => 'Let\'s return the content',
            'html' => view('pages.quotes.item', ['data' => $quotes])->render(),
            'current_page' => $arrayData['current_page'],
            'next_page_url' => $arrayData['next_page_url'],
            'to' => $arrayData['to'],
            'total' => $arrayData['total']
        ]);
    }

    public function Movies (Request $request)
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
            'html' => view('pages.movies.item', ['data' => $directors])->render(),
            'current_page' => $arrayData['current_page'],
            'next_page_url' => $arrayData['next_page_url'],
            'to' => $arrayData['to'],
            'total' => $arrayData['total']
        ]);
    }

    public function directors (Request $request)
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
            $sortCol = 'name_en';
            $sortOrder = 'asc';
        }
        elseif (request()->get('sort') == 4) {
            $sortCol = 'name_en';
            $sortOrder = 'desc';
        }

        $search = trim($request->get('search'));

        $directors = Directors::where('deleted', 0)->where(function ($query) use ($search) {
            $query->where('name_en', 'like', "%{$search}%")->orWhere('name_ka', 'like', "%{$search}%");
        })
        ->orderBy($sortCol, $sortOrder)->paginate(3);

        $arrayData = $directors->toArray();

        return response()->json([
            'message' => 'Let\'s return the content',
            'html' => view('pages.directors.item', ['data' => $directors])->render(),
            'current_page' => $arrayData['current_page'],
            'next_page_url' => $arrayData['next_page_url'],
            'to' => $arrayData['to'],
            'total' => $arrayData['total']
        ]);
    }
}
