<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\FileResizer;
use App\User;
use App\Album;
use App\UserAlbum;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userProfile(Request $request)
    {
        $user_id = $request->id;


        //user information
        $user = DB::table('users')
                  ->find($user_id);


        //albums information

        // $albums = Album::with('userAlbum')
        //                 ->where('user_id',$user_id)
        //                 ->orderBy('updated_at','desc')
        //                 ->get();

        
                           
        $albums = DB::table('albums')
                    ->join('user_albums','albums.id','=','user_albums.album_id')
                    ->where('user_albums.user_id','=',$user_id)
                    ->orderBy('albums.updated_at','desc')
                    ->limit(9)
                    ->get();

        $data = Array();
        

        foreach ($albums as $album) {
            $album_id = $album->id;
            $photos = DB::table('photos')
                      ->select('url','id','ratio_type')
                      ->where('album_id','=',$album_id)
                      ->orderBy('updated_at','desc')
                      ->limit(8)
                      ->get();

            foreach ($photos as $photo) {
                $album->photos[] =  $photo;
            }

            $data[] = ['album' => $album,'photos' =>$album->photos];

        }

        return view('user_profile',['user' => $user,'albums' => $data]);
    }

    public function editProfile(Request $request){

        $user_id = Auth::user()->id;

        //user information
        $user = DB::table('users')
                  ->find($user_id);

        return view('edit_profile',['user' => $user]);
    }

    public function updateProfile(Request $request){
        $user_id = Auth::user()->id;


        $avatar_file = $request->avatar;
        $name = $request->name;
        $employee_num = $request->employee_num;
        $email = $request->email;
        $department = $request->department;
        $introduction = $request->introduction;

        if($avatar_file){
            $pre_avatar_url = Auth::user()->avatar_url;

            if(file_exists(\public_path($pre_avatar_url)))
                unlink(\public_path('').'/'.$pre_avatar_url);
                
            // var_dump($pre_avatar_url);
            // unlink($pre_avatar_url);

            $avatar_url = '/'.Storage::disk('public')->put('image/avatars',$avatar_file);
        }else{
            $avatar_url = Auth::user()->avatar_url;
        }

        $param = ['name' => $name,
                  'employee_num' => $employee_num,
                  'email' => $email,
                  'introduction' => $introduction,
                  'department' => $department,
                  'avatar_url' => $avatar_url
                ];
        
        // var_dump($param);

        User::where('id',$user_id)
            ->update($param);
        

        return redirect('/user/'.$user_id);
        


    }

}