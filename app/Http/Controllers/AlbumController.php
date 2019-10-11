<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\UserAlbum;
use App\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\FileResizer;

// const RATIO_TYPE_WIDTH = 0;
// const RATIO_TYPE_HEIGHT = 1;

class AlbumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        return view('album_create');
    }

    public function show(Request $request)
    {

        $album_id = $request->id;

        $album = Album::find($album_id);

        $photos = $album->photos()->paginate(6);

        // dd($photos);

        $user = $album->userAlbum->user;


        return view('album_show',['album' => $album,'user' => $user,'photos' => $photos]);
    }

    public function createAlbum(Request $request)
    {        
        // save data to album
        $user_id = \Auth::user()->id;
        $album_title = $request->title;
        $description = $request->description;

        $album = new Album();
        $album->title = $album_title;
        $album->description = $description;

        $album->save();

        // // save data to user_album
        $user_album = new UserAlbum();
        $user_album->user_id = $user_id;

        $user_album->album_id = $album->id;

        $user_album->save();

        $photo_urls = $request->photo_urls;

        //save the photos data
        foreach ($photo_urls as $url) {
            # code...

            $photo = new Photo();
            // $photo->url = $url['url'];
            $photo->album_id = $album->id;

            //get the photoname
            $chunk = explode('/',$url['url']);
            $photoname = $chunk[1];

            $photo->url = $photoname;

            $originFile = \storage_path('app').'/'.$url['url'];
            $orignThumbnail = \storage_path('app/temp/thumbnails').'/'.$photoname;


            list($width,$height) = \getimagesize($originFile);

            // photo aspect ratio type
            if($width >= $height){
                $photo->ratio_type = RATIO_TYPE_WIDTH;
            }else{
                $photo->ratio_type = RATIO_TYPE_HEIGHT;
            }

            $photo->save();



            //copy the file to photos folder

            // copy(\storage_path('app').'/'.$url['url'],\public_path('image/photos').'/'.$photoname);
           
            copy($originFile,\public_path('image/photos').'/'.$photoname);

            // resize the orign image to thumbnail

            copy($orignThumbnail,\public_path('image/thumbnails').'/'.$photoname);

            // $resizer = new FileResizer($originFile);

            // $thumbnail = \public_path('image/thumbnails'.'/'.$photoname);

            // $resizer->resize(100,$thumbnail);
        }

    }

    public function delete(Request $request){
        // get the album_id from the request header referer
        $delete_url = $request->headers->get('referer');

        \preg_match('!\d+!',$delete_url,$album_ids);
        $album_id = $album_ids[0];
    
        $album = Album::find($album_id);

        $user_album = $album->userAlbum;

        $photos = $album->photos;



        foreach ($photos as $photo) {
            $photo_name = $photo->url;

            //delete the photos and thumbnail from the sever
            $photo_path = \public_path('image/photos').'/'.$photo_name;
            if(file_exists($photo_path))
                unlink($photo_path);

            $thumbnail_path = \public_path('image/thumbnails').'/'.$photo_name;
            if(file_exists($thumbnail_path))
                unlink($thumbnail_path);

            $likes = $photo->likes;

            foreach ($likes as $like) {
                # code...
                $like->delete();
            }
            
            $photo->delete();
        }

        $user_album->delete();

        $album->delete();


        return redirect("/user/".Auth::user()->id);

    }
}

