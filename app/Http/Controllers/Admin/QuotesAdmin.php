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
        $actions = new QuoteActions();
        if($actions->inputsFail()) return pleaseFillAllFields();

        $actions->insertData();
        return insertSuccessResponse();
    }

    public function QuotesJson (Request $request)
    {
        $actions = new QuoteActions();
        return $actions->AllToJson();
    }

    public function TheQuoteJson (Request $request)
    {
        $id = (int)trim($request->get('id'));
        $movies = Quotes::where('id', $id);

        if ($movies->count() == 0) return recordNotFoundResponse();

        return response()->json([
            'message' => __('main.record_found'),
            'status' => 1,
            'html' => view('admin.quotes.edit', ['row' => $movies->first()])->render()
        ]);
    }

    public function EditQuote (Request $request, int $id)
    {
        $actions = new QuoteActions();
        if($actions->inputsFail()) return pleaseFillAllFields();

        $check = Quotes::where('id', $id);
        if($check->count() == 0) return recordNotFoundResponse();

        $actions->id($id)->update();
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
