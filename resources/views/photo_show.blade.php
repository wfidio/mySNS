@extends('layouts.app')

@section('content')

    <div class="albums m-5">
        <div style="height: 120px;">
            <div class="album-avatar-container mb-4">
                <a href="/user/{{$user->id}}">
                    @if ($user->avatar_url)
                        <img class="album-avatar" src="{{$user->avatar_url}} ">
                    @else
                        <img class="album-avatar" src="{{DEFAULT_AVATAR_URL}} ">
                    @endif
                </a>
            </div>

           
            @if ($like_flag == false)
                <div id='like_btn' onclick="like()" photo_id="{{$photo->id}}" class="photo-unlike-icon">
                
                </div>
            @else
                <div id='unlike_btn' onclick="unlike()" photo_id="{{$photo->id}}" class="photo-like-icon">
                
                </div>
            @endif

            <div id="like_num" class="m-1">{{$like_num}}</div>

            


        </div>
        <h2>アルバム名：{{$album->title}}</h2>
        <h5>{{$album->description}}</h5>
        <div class="albums-container mt-4">
            @if ($photo->ratio_type == RATIO_TYPE_WIDTH)
                <a class="photo-container-width"  href="/photos/{{$photo->id}}">
                    <img src="{{PHOTOS_PATH.$photo->url}}" class="photo-width">
                </a>
            @elseif ($photo->ratio_type == RATIO_TYPE_HEIGHT)
                <a class="photo-container-height" href="/photos/{{$photo->id}}">
                    <img src="{{PHOTOS_PATH.$photo->url}}" class="photo-height">
                </a>
            @endif

        </div>
    </div>


    {{-- <div class="photo-pagination"> --}}
        {{-- {{$photos->links()}} --}}
    {{-- </div> --}}

@endsection

@section('css')
<link href="{{asset('css/user_profile.css')}}" rel="stylesheet">
<link href="{{asset('css/photo_show.css')}}" rel="stylesheet">
@endsection

@section('script')
<script src="{{asset('js/photo_show.js')}}"></script>
@endsection
