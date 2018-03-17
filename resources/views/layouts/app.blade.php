<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles --> 
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/header.css') }}" rel="stylesheet">
        <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
        <link href="{{ asset('css/login_register.css') }}" rel="stylesheet">
        <link href="{{ asset('css/movie.css') }}" rel="stylesheet">
        <link href="{{ asset('css/theater.css') }}" rel="stylesheet">
        <link href="{{ asset('css/seatmap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
        <link href="{{ asset('css/slick.css') }}" rel="stylesheet">
        <link href="{{ asset('css/slick-theme.css') }}" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    </head>
    <body>
        <nav class="navbar navbar-default navbar-static-top navbar-inverse">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fa fa-film fa-lg"></span> PHIM
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{!! url('movies/nowplay') !!}">PHIM ĐANG CHIẾU</a>
                                <a class="dropdown-item" href="{!! url('movies/comesoon') !!}">PHIM SẮP CHIẾU</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{!! url('theaters') !!}"><span class="fa fa-home fa-lg"></span> RẠP</a>
                        </li>
                        <li class="nav-item">
                            @if (Auth::check())
                                <a class="nav-link" href="{!! url('users/profile') !!}"><span class="fa fa-user fa-lg"></span> NGƯỜI DÙNG</a>
                            @else                    
                                <a class="nav-link" href="{!! url('login') !!}"><span class="fa fa-user fa-lg"></span> NGƯỜI DÙNG</a>
                            @endif                 
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                        <li><a>{{ 'Welcome ' . Auth::user()->name }}</a></li>
                        <li><a href="/" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <header class="jumbotron">
            <div class="container">
                <div class="row row-header">
                    <div class="col-md-8">
                        <h1 style="text-align: left;">{{ isset($pageTitle) ? $pageTitle : '' }}</h1>
                        <p>Chúng tôi hướng tới việc mang đến cho người dùng những trải nghiệm tuyệt vời nhất bên bạn bè và gia đình </p>
                    </div>
                    <div class="col-md-2">
                       
                    </div>
                    <div class="col-md-2 align-self-center">
                        <img src="{{ asset('img/film-icon.png') }}" class="icon-jumbotron" />
                    </div>
                </div>
            </div>
        </header>

        @yield('content')

        <!--================================================================-->
        <footer class="footer-distributed">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 footer-left">
                        <h3>CGV<span>demo</span></h3>
                        <br>
                        <p class="footer-company-name">CGV demo &copy; 2017</p>
                    </div>
                    <div class="col-md-4 footer-center">
                        <div>
                            <i class="fa fa-map-marker"></i>
                            <p><span>ĐẠI HỌC BÁCH KHOA HÀ NỘI</span></p>
                        </div>
                        <div>
                            <i class="fa fa-phone"></i>
                            <p>0916558096</p>
                        </div>
                        <div>
                            <i class="fa fa-envelope"></i>
                            <p><a href="mailto:support@company.com">support@company.com</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 footer-right">
                        <p class="footer-company-about">
                            <span>Về Chúng Tôi</span>
                            <p>Chúng tôi hướng tới việc mang đến cho người dùng những trải nghiệm tuyệt vời nhất bên bạn bè và gia đình </p>
                        </p>
                        <div class="footer-icons">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-github"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/slick.min.js') }}"></script>
    </body>
</html>
