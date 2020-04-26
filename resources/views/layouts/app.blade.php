<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel = "icon" type = "image/png" href = "{{ asset('images/logo/note.png') }}">
    <!-- For apple devices -->
    <link rel = "apple-touch-icon" type = "image/png" href = "{{ asset('images/logo/note.png') }}"/>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dock.css') }}" rel="stylesheet">
    @yield('ccs')
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Authentication Links -->
                @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Personal') }}
                    </a>
                @else
                    <a class="navbar-brand" href="/profile/{{Auth::user()->id}}">
                        {{ config('app.name', 'Personal') }}
                    </a>
                @endguest
                <form method="GET" action="/search" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <input id="search" type="text" class="form-control @error('search') is-invalid @enderror " name="search" 
                                value="{{ old('search') }}" maxlength=45 autofocus>
                        </div>
                        <div class="col-sm-1 px-0">
                            <input type="image" class="img-fluid" src="{{ asset('images/logo/search.png')}}" alt="Submit" />
                        </div>
                    </div>
                </form>
                
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @guest
    @else
        <div class="dockbg"></div>
        <div class="dock">
        @if (Auth::user()->acct_type == "1")
            <a href="/user/"><img src="{{ asset('images/logo/admin.png')}}"></a>
        @endif
            <a href="/profile/{{Auth::user()->id}}"><img src="{{ asset('images/logo/profile.png')}}"></a>
            <a href="/skills/{{Auth::user()->profile->id}}"><img src="{{ asset('images/logo/skills.png')}}"></a>
            <a href="/edu/{{Auth::user()->profile->id}}"><img src="{{ asset('images/logo/education.png')}}"></a>
            <a href="/work/{{Auth::user()->profile->id}}"><img src="{{ asset('images/logo/experience.png')}}"></a>
            <a href="https://github.com/laravel/laravel"> <img src="{{ asset('images/logo/github.png')}}"></a>
        </div>
    @endguest

    <!-- Scripts -->
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script> 
    @yield('scripts')
</body>
</html>
