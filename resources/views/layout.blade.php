<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel BBS</title>

    <link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
    >
</head>
<body>
    <div class="navbar navbar-dark bg-dark flex-center position-ref full-height">
        <a class="navbar-brand" href="{{ url('') }}">
            Laravel BBS
        </a>
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">ログイン</a>
                    <!-- <a href="{{ route('register') }}">Register</a> -->
                @endauth
            </div>
        @endif
    </div>

    <div>
        @yield('content')
    </div>
</body>
</html>
