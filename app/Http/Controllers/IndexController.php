<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Album;
use App\UserAlbum;

use View;

class IndexController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
    

        
        // $albums = DB::table('albums')
            // ->join('user_albums','albums.id','=','user_albums.album_id')
            // ->join('users','user_albums.user_id','=','users.id')
            // ->join('photos','photos.album_id','=','albums.id')
            // ->groupBy('album_id')
            // ->get();

        $albums = Album::orderBy('updated_at','desc')->get();

        $data = Array();

        foreach ($albums as $album) {
            # code...
            // $photos = 
            $data[] = ['album' => $album,'photos' => $album->photos->take(9),'user' => $album->userAlbum->user];
        }
        
        // foreach ($data as  $value) {
        //     # code...
        //     var_dump($value['phot']->id);
        // }
        // ->select('users.name as user_name','users.avatar_url','albums.id'
                    //  ,'users.id as user_id','albums.title','albums.description')
            // ->orderBy('albums.updated_at','desc')
            
            // ->get();

    //     foreach ($albums as $album) {
    //         $album_id = $album->id;
    //         $photos = DB::table('photos')
    //                 ->select('url','id','ratio_type')
    //                 ->where('album_id','=',$album_id)
    //                 ->orderBy('updated_at','desc')
    //                 ->limit(9)
    //                 ->get();


    //     foreach ($photos as $photo) {
    //         $album->photos[] =  $photo;
    //     }
    // }


        // foreach ($albums as $album) {
        //     // var_dump($album->photos);
        //     foreach ($album->photos as $photo) {
        //         var_dump($photo);
        //     }
        // }

        return view('index',['albums' => $data]);

    
    }

}