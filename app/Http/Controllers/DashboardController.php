<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HelperController;
use App\Models\Directors;
use App\Models\Quotes;
use App\Models\Movies;

use Validator;
use Image;

class DashboardController extends HelperController
{
    public function dashboard ()
    {
        return view('admin.dashboard');
    }











}
