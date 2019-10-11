<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //

    protected $table = 'albums';
    
    public static $rule = array(
        'title' => 'required'
    );

    public function userAlbum()
    {
        return $this->hasOne('App\UserAlbum', 'album_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo', 'album_id', 'id');
                    // ->orderBy('updated_at','desc');
    }
    
    
}
