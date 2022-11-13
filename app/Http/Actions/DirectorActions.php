<?php
namespace App\Http\Actions;
use App\Models\Directors;
use App\Models\Movies;
use App\Models\Quotes;
use Validator;

class DirectorActions{
    public $image = null;
    public $id = 0;

    public function ValidationFails(){
        $validator = Validator::make(request()->all(), [
            'name_en' => 'required|max:535',
            'name_ka' => 'required|max:535'
        ]);

        return $validator->fails();
    }

    public function ValidationError(){
        return response()->json([
            'message' => __('main.pleaseFillTheFields'),
            'status' => 0
        ]);
    }

    public function setImage ($image = null)
    {
        $this->image = trim($image);
        return $this;
    }

    public function Insert ()
    {
        Directors::insert([
            'name_en' => trim(request()->post('name_en')),
            'name_ka' => trim(request()->post('name_ka')),
            'image' => trim($this->image),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function id (int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function Update ()
    {
        $values = [
            'name_en' => trim(request()->post('name_en')),
            'name_ka' => trim(request()->post('name_ka'))
        ];

        if(strlen($this->image) > 24){
            $values['image'] = trim($this->saveBase64($this->image, 'directors'));
        }

        Directors::where('id', $this->id)->update($values);
    }

    function sortByNumTo(){
        $sortCol = 'id';
        $sortOrder = 'desc';

        if (request()->get('sort') == 1) {
            $sortCol = 'id';
            $sortOrder = 'asc';
        }
        elseif (request()->get('sort') == 3) {
            $sortCol = 'name_en';
            $sortOrder = 'asc';
        }
        elseif (request()->get('sort') == 4) {
            $sortCol = 'name_en';
            $sortOrder = 'desc';
        }
        else{
            $sortCol = 'id';
            $sortOrder = 'desc';
        }

        return (object)[
            'col' => $sortCol,
            'by' => $sortOrder
        ];
    }

    function AllToJson(){
        $sort = $this->sortByNumTo();
        $search = trim(request()->get('search'));

        $directors = Directors::where('deleted', 0)->where(function ($query) use ($search) {
            $query->where('name_en', 'like', "%{$search}%")->orWhere('name_ka', 'like', "%{$search}%");
        })
        ->orderBy($sort->col, $sort->by)->paginate(3);

        $arrayData = $directors->toArray();

        return response()->json([
            'message' => 'Let\'s return the content',
            'html' => view('admin.directors.item', ['data' => $directors])->render(),
            'current_page' => $arrayData['current_page'],
            'next_page_url' => $arrayData['next_page_url'],
            'to' => $arrayData['to'],
            'total' => $arrayData['total']
        ]);
    }

    function softDelete(){
        // მოვითხოვოთ ციტატების წაშლა სადაც რეჟისორი იგივეა
        Quotes::whereRaw('movie_id IN(SELECT id FROM movies WHERE movies.director_id = '.$this->id.')')->update(['deleted' => 1]);

        // წავშალოთ რეჟისორის ყველა ფილმი
        Movies::where('director_id', $this->id)->update(['deleted' => 1]);;

        // თავად ფილმიც გავუშვათ ნაგავში
        Directors::where('id', $this->id)->update(['deleted' => 1]);
    }
}
