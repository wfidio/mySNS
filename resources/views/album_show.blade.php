@extends('layouts.app')

@section('content')

    {{-- アルバム削除　--}}

    @if ($user->id == Auth::user()->id) 
        <form action="/album/delete" method="POST">
            {{ csrf_field() }}
            <button type="submit" class="btn">
                削除
            </button>
        </form>
    @else
        
    @endif
    

    <div class="albums m-5">
        <div class="album-avatar-container mb-4">
            <a href="/user/{{$user->id}}">
                @if ($user->avatar_url)
                    <img class="album-avatar" src="{{$user->avatar_url}} ">
                @else
                    <img class="album-avatar" src="{{DEFAULT_AVATAR_URL}} ">
                @endif
            </a>
        </div>
        <h2>アルバム名：{{$album->title}}</h2>
        <h5>{{$album->description}}</h5>
        <div class="albums-container mt-4">

                @foreach ($photos as $photo)
                {{-- <div class="profile-album-container m-3"> --}}
                    @if ($photo->ratio_type == RATIO_TYPE_WIDTH)
                        <a class="photo-container-width m-4" href="/photos/{{$photo->id}}">
                            <img src="{{PHOTOS_PATH.$photo->url}}" class="photo-width">
                        </a>
                    @elseif ($photo->ratio_type == RATIO_TYPE_HEIGHT)
                        <a class="photo-container-height m-4" href="/photos/{{$photo->id}}">
                            <img src="{{PHOTOS_PATH.$photo->url}}" class="photo-height">
                        </a>
                    @endif

                    b:if
                        
                    {{-- </div> --}}
                @endforeach

        </div>
    </div>

    {{-- <div class="photo-pagination"> --}}
        {{$photos->links()}}
    {{-- </div> --}}

@endsection

@section('css')
<link href="{{asset('css/user_profile.css')}}" rel="stylesheet">
<link href="{{asset('css/album_show.css')}}" rel="stylesheet">
@endsection
