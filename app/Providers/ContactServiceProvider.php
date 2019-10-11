<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\User;
use Illuminate\Support\Facades\Auth;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
        // View::composer('index', function ($view) {
        //     $users = User::where('id','<>',Auth::user()->id)->limit(6)->get();
            
        //     $users_num = User::where('id','<>',Auth::user()->id)->count();

        //     $view->with('sns_users',$users)->with('sns_users_num',$users_num);
        // });

        view()->composer('index', 'App\Http\ContactComposer');
        view()->composer('album_create', 'App\Http\ContactComposer');
        view()->composer('album_show', 'App\Http\ContactComposer');
        view()->composer('edit_profile', 'App\Http\ContactComposer');
        view()->composer('photo_show', 'App\Http\ContactComposer');
        view()->composer('user_profile', 'App\Http\ContactComposer');

    }
}
