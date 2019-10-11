<?php

namespace App\Http;


use Illuminate\View\View;
use App\User;
use Illuminate\Support\Facades\Auth;

class ContactComposer{
    public function compose(View $view){
        $users = User::where('id','<>',Auth::user()->id)->limit(6)->get();
            
        $users_num = User::where('id','<>',Auth::user()->id)->count();

        $view->with('sns_users',$users)->with('sns_users_num',$users_num);
    }
}