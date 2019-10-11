@extends('layouts.app')

@section('content')
    <div class="personal-information-container row m-5">
        <div class="profile-avatar-container col-2 text-center">
            <div class="profile-avatar m-2">
                @if ($user->avatar_url)
                    <img src="{{$user->avatar_url}}" class="profile-avatar-image">
                @else
                    <img src="{{DEFAULT_AVATAR_URL}}" class="profile-avatar-image">
                @endif
                {{-- <img src="/image/avatars/default_avatar.png" class="profile-avatar-image"> --}}
            </div>
            @if ($user->id == Auth::user()->id)
                <a href='/edit/user' class="btn btn-primary">
                    Edit
                </a>
            @else
                <button id='follow_btn' class="btn btn-primary">
                    Follow
                </button>
            @endif
            
        </div>
        <div class="profile_information col-8">
            <h2 class="profile-label">名前: {{$user->name}}</h2>
            <h2 class="profile-label">社員番号: {{$user->employee_num}}</h2>
            <h2 class="profile-label">部署: {{$user->department}}</h2>
            <h2 class="profile-label">Email: {{$user->email}}</h2>
        </div>
    </div>
    <div class="profile-self-introduction m-5">
        <h2>自己紹介文</h2>
        <div class="self-introduction-container mt-4 p-2">
            @if ($user->introduction)
                {{$user->introduction}}
            @else
                この人は自己紹介がない。
            @endif
        </div>
    </div>

    <div class="profile-ablums m-5">
        <h2>アルバム</h2>
        <div class="profile-albums-container mt-4">
            @foreach ($albums as $album)
                <div class="profile-album-container m-3">
                    @foreach ($album['photos'] as $photo)
                        @if ($photo->ratio_type == RATIO_TYPE_WIDTH)
                            <a class="profile-photo-container-width m-1" href="/photos/{{$photo->id}}">
                                <img src="{{THUMBNAILS_PATH.$photo->url}}" class="profile-photo-width">
                            </a>
                        @elseif($photo->ratio_type == RATIO_TYPE_HEIGHT)
                            <a class="profile-photo-container-height m-1" href="/photos/{{$photo->id}}">
                                <img src="{{THUMBNAILS_PATH.$photo->url}}" class="profile-photo-height">
                            </a>
                        @endif
                    @endforeach
                        <a class="profile-photo-container-width m-1" href="/albums/{{$album['album']->id}}">
                            Enter the album
                        </a>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('css')
<link href="{{asset('css/user_profile.css')}}" rel="stylesheet">
@endsection
