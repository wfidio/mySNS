<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use App\Like;
use Illuminate\Support\Facades\Auth;


class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request){
        $photo_id = $request->id;

        $photo = Photo::find($photo_id);

        $album = $photo->album;

        $user = $album->userAlbum->user;

        $like = Like::where('photo_id',$photo_id)->where('user_id',Auth::user()->id)->first();

        $like_num = Like::where('photo_id',$photo_id)->count();


        $like_flag = false;

        if($like)
            $like_flag = true;

        return view('photo_show',
            ['photo' => $photo,
             'album' => $album,
             'user' => $user,
             'like_flag' => $like_flag,
             'like_num' => $like_num
             ]
        );
    }

    public function like(Request $request){

        $like = new Like();

        $like->user_id = Auth::user()->id;
        $like->photo_id = $request->photo_id;

        $like->save();
    
        $like_num = Like::where('photo_id',$request->photo_id)->count();
        
        return $like_num;
    
    }

    public function unlike(Request $request){
        $user_id = Auth::user()->id;
        $photo_id = $request->photo_id;

        $like = Like::where('user_id',$user_id)->where('photo_id',$photo_id)->first();

        $like->delete();

        $like_num = Like::where('photo_id',$request->photo_id)->count();
        
        return $like_num;

    }
}