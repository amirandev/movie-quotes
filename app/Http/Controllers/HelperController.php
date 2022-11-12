<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function saveBase64($data, $folder = 'images')
    {
        $img = $data;
        $img = str_replace('data:image/jpg;base64,', '', $img);
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $dataSave = base64_decode($img);
        $new_filename = 'image_'.time().'_'.randomString(8).'.png';
        $randName = public_path('/uploads/'.trim($folder).'/'.$new_filename);
        $success = file_put_contents($randName, $dataSave);
        return $new_filename;
    }

    public function dropImage($imageName = '')
    {
        $imageName = trim($imageName);
        if(strlen($imageName) > 6){
            $path = public_path('/upload/images/'.$imageName);
            chmod($path, 0777);
            unlink($path);
        }
    }
}
