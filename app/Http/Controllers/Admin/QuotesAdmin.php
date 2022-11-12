<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\HelperController;
use Illuminate\Http\Request;
use App\Models\Movies;
use App\Models\Quotes;
use App\Models\Directors;
use Validator;

class QuotesAdmin extends HelperController
{
    public function Quotes ()
    {
        return view('admin.quotes.list');
    }

    public function AddMovie (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'text_en' => 'required|max:535',
            'text_ka' => 'required|max:535',
            'movie' => 'required|numeric'
        ]);

        if ($validator->fails()) return pleaseFillAllFields();

        $image = $this->saveBase64($request->post('thumbnail'), 'quotes');

        Quotes::insert([
            'text_en' => trim($request->post('text_en')),
            'text_ka' => trim($request->post('text_ka')),
            'movie_id' => trim($request->post('movie')),
            'image' => trim($image),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return insertSuccessResponse();
    }

    public function QuotesJson (Request $request)
    {
        $search = trim($request->get('search'));

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

    public function TheQuoteJson (Request $request)
    {
        $id = (int)trim($request->get('id'));
        $movies = Quotes::where('id', $id);

        if ($movies->count() == 0) return recordNotFoundResponse();

        return response()->json([
            'message' => 'ჩანაწერი ნაპოვნია',
            'status' => 1,
            'html' => view('admin.quotes.edit', ['row' => $movies->first()])->render()
        ]);
    }

    public function EditQuote (Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'text_en' => 'required|max:535',
            'text_ka' => 'required|max:535',
            'movie' => 'required|numeric'
        ]);

        if ($validator->fails()) return pleaseFillAllFields();

        $check = Quotes::where('id', $id);
        if($check->count() == 0) return recordNotFoundResponse();
        $postedImage = trim($request->post('thumbnail'));

        $values = [
            'text_en' => trim($request->post('text_en')),
            'text_ka' => trim($request->post('text_ka')),
            'movie_id' => trim($request->post('movie')),
        ];

        if(strlen($postedImage) > 24){
            $values['image'] = trim($this->saveBase64($postedImage, 'quotes'));
        }

        Quotes::where('id', $id)->update($values);

        return updateSuccessResponse();
    }

    public function SoftDelete (Request $request)
    {
        $id = (int)trim($request->post('id'));
        $quote = Quotes::where('id', $id);

        if($quote->count() == 0) return recordNotFoundResponse();

        // მოვითხოვოთ ციტატების წაშლა სადაც რეჟისორი იგივეა
        Quotes::where('id', $id)->update(['deleted' => 1]);

        return deleteSuccessResponse();
    }
}
