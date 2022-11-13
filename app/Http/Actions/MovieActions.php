<?php
namespace App\Http\Actions;
use App\Models\Directors;
use App\Models\Movies;
use App\Models\Quotes;
use Validator;

class MovieActions {

    public $id = 0;

    public function AllToJson(){
        $sortCol = 'id';
        $sortOrder = 'desc';

        if (request()->get('sort') == 1) {
            $sortCol = 'id';
            $sortOrder = 'asc';
        }
        elseif (request()->get('sort') == 3) {
            $sortCol = 'title_en';
            $sortOrder = 'asc';
        }
        elseif (request()->get('sort') == 4) {
            $sortCol = 'title_en';
            $sortOrder = 'desc';
        }

        $search = trim(request()->get('search'));

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

    public function inputsFail()
    {
        $validator = Validator::make(request()->all(), [
            'title_en' => 'required|max:535',
            'title_ka' => 'required|max:535',
            'director' => 'required|numeric'
        ]);

        return $validator->fails();
    }

    public function insertData ()
    {
        $image = $this->saveBase64(request()->post('thumbnail'), 'movies');

        Movies::insert([
            'title_en' => trim(request()->post('title_en')),
            'title_ka' => trim(request()->post('title_ka')),
            'director_id' => trim(request()->post('director')),
            'image' => trim($image),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function id (int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function update()
    {
        $postedImage = trim(request()->post('thumbnail'));

        $values = [
            'title_en' => trim(request()->post('title_en')),
            'title_ka' => trim(request()->post('title_ka')),
            'director_id' => trim(request()->post('director'))
        ];

        if(strlen($postedImage) > 24){
            $values['image'] = trim($this->saveBase64($postedImage, 'movies'));
        }

        Movies::where('id', $this->id)->update($values);
    }

}
