@extends('layouts.app')

@section('script')
<script src="{{asset('js/album_create.js')}}"></script>
    
@endsection

@section('content')

    <h1 class="m5"> Create Your Album</h1>
    {{-- <form action="/album/create" method="POST"> --}}
        <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>

                <div class="col-md-3">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        </div>

        <div class="form-group row">
                <label for="Description" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>

                <div class="col-md-6">
                    <textarea id="description" rows='4' cols ='50' class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>
                    </textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        </div>

        {{-- <div class="form-group custom-file m-5 row text-center">
                <input type="file" class="custom-file-input col-md-6" id="file_upload" onchange="uploadFile(e)" name="photos[]" multiple accept="image/*">
                <label class="custom-file-label col-md-6" for="customFile">Upload Your Photos</label>
        </div> --}}

        <input type="file" id="files" name="files" accept="image/jpeg,image/png,image/gif,image/bmp" multiple />

        <div class="photos-list-container mb-5" >
            <div id="photos-list" class="photos-list" data-photourl='[]'>
                    {{-- <div class="photo-container">
                        <img class='photo' src="/image/default_avator.png">
                    </div> --}}
            </div>
        </div>

        <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button id="submit_btn" type="click" class="btn btn-primary" onclick="">
                        {{ __('Submit') }}
                    </button>
                </div>
        </div>

    {{-- </form> --}}
@endsection