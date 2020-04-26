<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Personal Website</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="css/welcome.css"> 
        <link rel="stylesheet" href="css/app.css"> 
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="/profile/{{ Auth::user()->id }}">Profile</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    My Resume
                </div>
                <form method="GET" action="/search" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-11">
                            <input id="search" type="text" class="form-control @error('search') is-invalid @enderror " name="search" 
                                value="{{ old('search') }}" maxlength=45 autofocus>
                        </div>
                        <div class="col-sm-1 px-0">
                            <input type="image" class="img-fluid" src="{{ asset('images/logo/search.png')}}" alt="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
