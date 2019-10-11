<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\FileResizer;


class FileController extends Controller
{
    public function uploadPhotos(Request $request)
    {
        $files = $request->photos;


        $filenames = array();
        foreach ($files as $file) {
            $filename = Storage::put('temp',$file['photo']);

            //resize the photos
            $chunk = explode('/',$filename);
            $photoname = $chunk[1];

            $resizer = new FileResizer(\storage_path('app'.'/'.$filename));

            $resizer->resize(100,\storage_path('app/temp/thumbnails'.'/'.$photoname));

            $filenames[] = $filename;
        }

        return json_encode($filenames);

    }
}