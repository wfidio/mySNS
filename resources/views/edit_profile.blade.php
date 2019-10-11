@extends('layouts.app')

@section('content')
    <form method="POST" action="/edit/user" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="personal-information-container row m-5">
            <div class="profile-avatar-container col-2 text-center">
                <div class="profile-avatar m-2">
                    @if ($user->avatar_url)
                        <img src="{{$user->avatar_url}}" id="profile-avatar-image" class="profile-avatar-image">
                    @else
                        <img src="{{DEFAULT_AVATAR_URL}}" id="profile-avatar-image" class="profile-avatar-image">
                    @endif
                </div>
                <input name='avatar' id='avatar_upload' type="file" accept="image/*"  value="upload avator">

                {{-- <a href='/user/{{$user->id}}/edit' class="btn btn-primary">
                        Edit
                </a> --}}
            </div>
            <div class="profile_information col-10">
                <div class="form-group row">
                    <label for="name" class="col-sm-1 col-form-label text-md-right">名前</label>
                    <div class="col-sm-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{  $user->name   }}" required autocomplete="name" autofocus>
        
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                        <label for="employee_num" class="col-sm-1 col-form-label text-md-right">社員番号</label>
                        <div class="col-sm-3">
                            <input id="employee_num" type="text" class="form-control @error('employee_num') is-invalid @enderror" name="employee_num" value="{{ $user->employee_num }}" required autocomplete="employee_num" autofocus>
            
                            @error('employee_num')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>

                <div class="form-group row">
                        <label for="department" class="col-sm-1 col-form-label text-md-right">部署</label>
                        <div class="col-md-4">
                            <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ $user->department }}"  autocomplete="department" autofocus>
            
                            @error('department')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>


                <div class="form-group row">
                        <label for="email" class="col-sm-1 col-form-label text-md-right">Email</label>
                        <div class="col-md-4">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>


            </div>
        </div>

        <div class="profile-self-introduction m-5">
            <h2>自己紹介文</h2>

            <div class="form-group row m-2">
                <textarea id="introduction" rows="10" class="col-5 form-control @error('introduction') is-invalid @enderror" placeholder="Say Something" name="introduction"   autocomplete="introduction" autofocus>{{ $user->introduction }}</textarea>
                @error('introduction')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button id="submit_btn" type="submit" class="btn btn-primary" onclick="">
                        編集
                    </button>
                </div>
        </div>
    </form>

@endsection

@section('css')
<link href="{{asset('css/user_profile.css')}}" rel="stylesheet">
@endsection

@section('script')
<script src="{{asset('js/profile_update.js')}}"></script>
@endsection