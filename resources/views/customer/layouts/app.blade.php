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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Scripts -->
    <script src="{{ asset('js/layout.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    @yield('head')

</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="recommendmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hỗ trợ lựa chọn phim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('movie/recommend') }}" method="post">
                        {{ csrf_field() }}
                        <h6>Thể loại phim</h6>
                        <div class="form-group">
                            <select class="form-control" id="" name="genre">
                                <option value="">Thể loại phim</option>
                                <option value="action">Hành động</option>
                                <option value="romance">Tâm lý, tình cảm</option>
                                <option value="horror">Kinh dị</option>
                                <option value="adventure">Phiêu lưu</option>
                                <option value="scientific">Viễn tưởng</option>
                            </select>
                        </div>
                        <h6>Năm phát hành</h6>
                        <div class="form-group">
                            <select class="form-control" id="" name="year">
                                <option value="">Năm phát hành</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                            </select>
                        </div>
                        <h6>Quốc gia</h6>
                        <div class="form-group">
                            <select class="form-control" id="" name="country">
                                <option value="">Quốc gia</option>
                                <option value="usa">Mỹ</option>
                                <option value="vie">Việt Nam</option>
                                <option value="kor">Hàn Quốc</option>
                                <option value="jap">Nhật Bản</option>
                                <option value="chi">Trung Quốc</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" id="hid-recommend-btn" class="btn btn-primary hidden"></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" id="recommend-btn" class="btn btn-primary">Tìm phim phù hợp</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ (\Request::is('/')) ? " active " : " " }}">
                    <a class="nav-link" href="{{ url('/') }}">
                        Trang chủ
                    </a>
                </li>
                <li class="nav-item dropdown {{ (\Request::is('movie/*')) ? " active " : " " }}">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fa fa-film fa-lg"></span> PHIM
                        </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{!! url('movie/now-playing') !!}">PHIM ĐANG CHIẾU</a>
                        <a class="dropdown-item" href="{!! url('movie/comming-soon') !!}">PHIM SẮP CHIẾU</a>
                    </div>
                </li>
                <li class="nav-item {{ (\Request::is('theater')) ? " active " : " " }}">
                    <a class="nav-link" href="{!! url('theater') !!}"><span class="fa fa-home fa-lg"></span> RẠP</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <form class="form-inline my-2 my-lg-0" action="{{ route('movie.search') }}" method="GET">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <!-- Authentication Links -->
                @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                @else
                <li><a href="{!! url('user/profile') !!}">{{ 'Welcome ' . Auth::user()->name }}</a></li>
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if (auth()->user()->unreadNotifications->count())
                        <span class="label label-primary">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        @if (auth()->user()->unreadNotifications->count())
                        {{-- <li class="header"><a style="color:green" href="{{ route('mark-read') }}">Mark all as Read</a></li> --}}
                        <li class="header"><a style="color:green" id="mark-read">Mark all as Read</a></li>
                        @endif
                        <li>
                        <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                    <li class="unread-noti" style="background-color: lightgray">
                                        <a href="#">
                                            <i class="fa fa-envelope text-aqua"></i> {{ $notification->data['noti'] }}
                                            @if ($notification->data['hasButton'])
                                            <p class="accept-decline-box-{{ $notification->data['invitationId'] }}">
                                                <button class="btn btn-sm btn-danger pull-right ml-1 decline-join" data="{{ $notification->data['invitationId'] }}">Từ chối</button>
                                                <button class="btn btn-sm btn-primary pull-right accept-join" data="{{ $notification->data['invitationId'] }}">Đồng ý</button>
                                            </p>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                                @foreach (auth()->user()->readNotifications as $notification)
                                    <li class="read-noti">
                                        <a href="#">
                                            <i class="fa fa-envelope text-aqua"></i> {{ $notification->data['noti'] }}
                                            @if ($notification->data['hasButton'])
                                            <p class="accept-decline-box-{{ $notification->data['invitationId'] }}">
                                                <button class="btn btn-sm btn-danger pull-right ml-1 decline-join" data="{{ $notification->data['invitationId'] }}">Từ chối</button>
                                                <button class="btn btn-sm btn-primary pull-right accept-join" data="{{ $notification->data['invitationId'] }}">Đồng ý</button>
                                            </p>
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="/" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endguest
            </ul>
        </div>
    </nav>

    <header class="jumbotron">
        <div class="container">
            <div class="row row-header">
                <div class="col-md-8">
                    <h1 style="text-align: left;">{{ isset($pageTitle) ? $pageTitle : '' }}</h1>
                    <p>Chúng tôi hướng tới việc mang đến cho người dùng những trải nghiệm tuyệt vời nhất bên bạn bè và gia đình
                    </p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="#" role="button" data-toggle="modal" data-target="#recommendmodal">
                                Hỗ trợ chọn phim
                            </a>
                    </p>
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
                    <p class="footer-company-name">CGV demo &copy; 2018</p>
                </div>
                <div class="col-md-4 footer-center">
                    <div>
                        <i class="fa fa-map-marker"></i>
                        <p><span>ĐẠI HỌC BÁCH KHOA HÀ NỘI</span></p>
                    </div>
                    <div>
                        <i class="fa fa-phone"></i>
                        <p>0123456789</p>
                    </div>
                    <div>
                        <i class="fa fa-envelope"></i>
                        <p><a href="mailto:support@company.com">support@company.com</a></p>
                    </div>
                </div>
                <div class="col-md-6 footer-right">
                    <p class="footer-company-about">
                        <span>Về Chúng Tôi</span>
                        <p>Chúng tôi hướng tới việc mang đến cho người dùng những trải nghiệm tuyệt vời nhất bên bạn bè và gia
                            đình </p>
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
</body>

<script src="{{ asset('js/notify.js') }}"></script>
</html>