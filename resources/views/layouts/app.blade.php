<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->

    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @yield('css')

    

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container ">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{-- {{ Auth::user()->name }} <span class="caret"></span> --}}
                                    <div class="header_avator_container">
                                        @if (Auth::user()->avatar_url)
                                            <img class="avator_img" src="{{Auth::user()->avatar_url}}">
                                        @else
                                            {{-- <img class="avator_img" src="/image/avatars/default_avatar.png"> --}}
                                            <img class="avator_img" src="{{DEFAULT_AVATAR_URL}}" />
                                        @endif
                                    </div>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a class="dropdown-item" href="/user/{{Auth::user()->id}}">
                                        {{__('User Profile')}}
                                    </a>
                                
                                    <a class="dropdown-item" href="/albums/create">
                                        {{__('Create Album')}}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" style="height:1280px">
            @if (Route::currentRouteName() == 'login' || Route::currentRouteName() == 'register')
                <div class="content">
                    @yield('content')
                </div>
            @else
                <div class="row" style="height:100%">
                    <div class="contact  col-sm-2">
                        <div class="contact_list p-2" >
                                    <div class="contact_list_header" data-toggle="dropdown">
                                        <span>You</span>
                                    </div>
                                    <div class="contact-dropdown-menu">
                                      <a class="contact-dropdown-item"  href="/user/{{Auth::user()->id}}">
                                        <div class="contact_avatar_container">
                                            @if (Auth::user()->avatar_url)
                                                <img src="{{Auth::user()->avatar_url}}" class="contact_avatar">
                                                    @else
                                                <img src="/image/avatars/default_avatar.png" class="contact_avatar">
                                                    @endif
                                            </div>
                                            <div class="contact_information">
                                                <div class="contact_information_name">
                                                      {{Auth::user()->name}}
                                                </div>
                                                <div class="contact_information_department">
                                                      {{Auth::user()->department}}
                                                </div>
                                                <div class="contact_information_introduction">
                                                      {{Auth::user()->introduction}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                        <div class="contact_list p-2" >
                            <div class="contact_list_header" data-toggle="dropdown">
                                <span>Users</span>
                            </div>
                            <div class="contact-dropdown-menu" id="contact-users">
                                  @foreach ($sns_users as $user)
                              <a class="contact-dropdown-item user_item"  href="/user/{{$user->id}}">
                                <div class="contact_avatar_container">
                                    @if ($user->avatar_url)
                                        <img src="{{$user->avatar_url}}" class="contact_avatar">
                                            @else
                                        <img src="/image/avatars/default_avatar.png" class="contact_avatar">
                                            @endif
                                    </div>
                                    <div class="contact_information">
                                        <div class="contact_information_name">
                                              {{$user->name}}
                                        </div>
                                        <div class="contact_information_department">
                                              {{$user->department}}
                                        </div>
                                        <div class="contact_information_introduction">
                                              {{$user->introduction}}
                                        </div>
                                    </div>
                                </a>
                                      @endforeach
                            </div>
                            <div id="more_user" >
                                More Users(<span id="current_user_num">{{$sns_users->count()}}</span>/{{$sns_users_num}})
                            </div>
                        </div>

                        

                    </div>
    
                    <div class="content col-sm-10 p-4" >
                        @yield('content')
                    </div>
                </div>
            @endif      
        </main>

        <div class="row footer text-center">
                <p> Lincensed By Wangyuyu@Lifull.com </p>
        </div>
    </div>
</body>

<script>
        // console.log(window.innerWidth);
        document.body.style.zoom = window.innerWidth / 1920;
</script>

<script src="{{ asset('js/app.js') }}" ></script>

@if (Route::currentRouteName() != 'login' && Route::currentRouteName() != 'register')
<script src="{{asset('js/contact.js')}}"></script>
@endif

@yield('script')
</html>
