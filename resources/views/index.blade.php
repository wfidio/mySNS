@extends('layouts.app')



@section('content')
    @foreach ($albums as $album)
    <div class="card album_card">
            <div class="card-header">
                <div class="header_avator_container">
                    <a href="/user/{{$album['user']->id}}">
                        {{-- <img class="avator_img" src="/image/avatars/default_avatar.png" /> --}}
                        @if ($album['user']->avatar_url)
                            <img class="avator_img" src="{{$album['user']->avatar_url}}" />                        
                        @else
                            <img class="avator_img" src="{{DEFAULT_AVATAR_URL}}">
                        @endif
                    </a>
                </div>
                <div class="card-header-name">
                    {{$album['user']->name}}
                </div>
                
                <div class="card-header-more">
                    <a href="albums/{{$album['album']->id}}">
                        Detail
                    </a>
                </div>
            </div>
            <div class="card-body" >
                <h5 class="card-title">{{$album['album']->title}}</h5>
                <p class="card-text">{{$album['album']->description}}</p>
                <div class="card-image-list">

                    @foreach ($album['photos'] as $photo)
                    @if ($photo->ratio_type == 0)
                        <a href='/photos/{{$photo->id}}' class="image-container-width">
                            
                            <img src="{{THUMBNAILS_PATH.$photo->url}}" class="card-album-photo-width">
                        </a>
                    @else
                        <a href='/photos/{{$photo->id}}' class="image-container-height">
                            <img src="{{THUMBNAILS_PATH.$photo->url}}" class="card-album-photo-height">
                        </a>                     
                    @endif
                    @endforeach
                    <a href='/albums/{{$album['album']->id}}' class="image-container-width">
                        more
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@endsection


