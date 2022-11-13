<?php
namespace App\Http\Actions;
use App\Models\Directors;
use App\Models\Movies;
use App\Models\Quotes;
use Validator;

class QuoteActions {

    public $id = 0;

    public function inputsFail()
    {
        $validator = Validator::make(request()->all(), [
            'text_en' => 'required|max:535',
            'text_ka' => 'required|max:535',
            'movie' => 'required|numeric'
        ]);

        return $validator->fails();
    }

    public function insertData ()
    {
        $image = $this->saveBase64(request()->post('thumbnail'), 'quotes');

        Quotes::insert([
            'text_en' => trim(request()->post('text_en')),
            'text_ka' => trim(request()->post('text_ka')),
            'movie_id' => trim(request()->post('movie')),
            'image' => trim($image),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function AllToJson(){
        $search = trim(request()->get('search'));

        $quotes = Quotes::where('deleted', 0)->where(function ($query) use ($search) {
            $query->where('text_en', 'like', "%{$search}%")->orWhere('text_ka', 'like', "%{$search}%");
        })
        ->orderBy('id', 'desc')->paginate(4);

        $arrayData = $quotes->toArray();

        return response()->json([
            'message' => 'Let\'s return the content',
            'html' => view('admin.quotes.item', ['data' => $quotes])->render(),
            'current_page' => $arrayData['current_page'],
            'next_page_url' => $arrayData['next_page_url'],
            'to' => $arrayData['to'],
            'total' => $arrayData['total']
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
            'text_en' => trim(request()->post('text_en')),
            'text_ka' => trim(request()->post('text_ka')),
            'movie_id' => trim(request()->post('movie')),
        ];

        if(strlen($postedImage) > 24){
            $values['image'] = trim($this->saveBase64($postedImage, 'quotes'));
        }

        Quotes::where('id', $this->id)->update($values);
    }

}
