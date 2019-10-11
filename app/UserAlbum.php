<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAlbum extends Model
{
    //
    protected $table = 'user_albums';
    
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    
}
