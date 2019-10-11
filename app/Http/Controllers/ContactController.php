<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;



class ContactController extends Controller{

    public function showMoreContact(Request $request){
        $offset = $request->offset;

        $users = User::where('id','<>',Auth::user()->id)->offset($offset)->limit(6);

        // $users = User::get();
        return json_encode($users);
    }

}