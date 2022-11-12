<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\HelperController;
use App\Http\Actions\Directors as DirectorActions;
use App\Models\Directors;
use App\Models\Quotes;
use App\Models\Movies;
use Validator;
use Image;

class DirectorsAdmin extends HelperController
{
    public function directors ()
    {
        return view('admin.directors.list');
    }

    public function StoreDirector (Request $request)
    {
        $actions = new DirectorActions();
        if($actions->ValidationFails()) return $actions->ValidationError();

        $image = $this->saveBase64($request->post('director_image'), 'directors');
        $actions->setImage($image)->Insert();

        return insertSuccessResponse();
    }


    public function EditDirector (Request $request, int $id)
    {
        $actions = new DirectorActions();
        if($actions->ValidationFails()) return $actions->ValidationError();

        if(Directors::where('id', $id)->count() == 0) return recordNotFoundResponse();

        $actions->setImage($request->post('director_image'))->id($id)->Update();
        return updateSuccessResponse();
    }

    public function directorsJson (Request $request)
    {
        $actions = new DirectorActions();
        return $actions->AllToJson();
    }

    public function TheDirectorJson (Request $request)
    {
        $id = (int)trim($request->get('id'));
        $directors = Directors::where('id', $id);

        if ($directors->count() == 0) return recordNotFoundResponse();

        return response()->json([
            'message' => __('main.record_found'),
            'status' => 1,
            'html' => view('admin.directors.edit', ['row' => $directors->first()])->render()
        ]);
    }

    public function SoftDeleteDirector (Request $request)
    {
        $director_id = (int)trim($request->post('id'));
        $director = Directors::where('id', $director_id);
        if($director->count() == 0) return recordNotFoundResponse();

        $actions = new DirectorActions();
        $actions->id($director_id)->softDelete();

        return deleteSuccessResponse();
    }

}
