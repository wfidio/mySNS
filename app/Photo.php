<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    public function album()
    {
        return $this->belongsTo('App\Album', 'album_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like', 'photo_id', 'id');
    }
}
