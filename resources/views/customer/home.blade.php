@extends('customer.layouts.app')

@section('content')

<div class="container">
    <div class="main-content">
        <div class="category-title">
            <br /><h1>PHIM ĐANG CHIẾU</h1><br />
        </div>
        <div>
            <div class="row row-content category-product slide">
                @foreach ($nowplay as $movie)
                <div class="col-sm-3 movie-list">
                    <div class="movie-info-home">
                        <span class="movie-rating">{{ $movie->rating }}</span>
                        <div class="movie-image">
                            <img class="img-url-movie" src="{{ '/img/' . $movie->url }}" />
                        </div>
                    </div>
                    <div action="" method="post" class="movie-info-detail">
                        <h5 class="movie-name">{{ $movie->title }}</h5>
                        <div class="extra-movie-info">
                            <span class="info-bold">Thể loại:</span>
                            <span class="info-normal">{{ $movie->genres }}</span>
                        </div>
                        <div class="extra-movie-info">
                            <span class="info-bold">Thời lượng:</span>
                            <span class="info-normal">{{ $movie->length }} phút</span>
                        </div>
                        <div class="extra-movie-info">
                            <span class="info-bold">Khởi chiếu:</span>
                            <span class="info-normal">{{ $movie->release_date }}</span>
                        </div>
                        <div class="extra-movie-info">
                            <span class="info-bold">Phụ đề:</span>
                            <span class="info-normal">{{ $movie->subtitle }}</span>
                        </div>
                        <div class="extra-movie-info">
                            <span class="info-bold">Rated:</span>
                            <span class="info-normal">{{ $movie->rating }}</span>
                        </div>
                        <div class="extra-movie-info">
                            <span class="info-bold">Đạo diễn:</span>
                            <span class="info-normal">{{ $movie->director }}</span>
                        </div>
                        <div class="extra-movie-info">
                            <span class="info-bold">Quốc gia:</span>
                            <span class="info-normal">{{ $movie->country }}</span>
                        </div>
                        @if (!Auth::check())
                        <button class="btn-auth">
                            <span class="icon-like fa fa-thumbs-o-up"></span>
                            <span>Like</span>
                        </button>
                        @else
                        @if ($movieObj->checkLike($movie->id))
                        <button type="submit" name="submit-like" class="btn-like liked" data-id="{{ $movie->id }}">
                            <span class="icon-like fa fa-check"></span>
                            <span>Like</span>
                        </button>
                        @else
                        <button type="submit" name="submit-like" class="btn-like unlike" data-id="{{ $movie->id }}">
                            <span class="icon-like fa fa-thumbs-o-up"></span>
                            <span>Like</span>
                        </button>
                        @endif
                        @endif
                        <a href="{{ url('theater/' . $movie->id) }}">
                            <button class="buy-ticket-button">
                                <span>Mua vé</span>
                            </button>
                        </a>
                        <div class = "clear"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!--================================================================-->
        <div class="category-title">
            <br /><h1>PHIM SẮP CHIẾU</h1><br />
        </div>
        <div class="row row-content category-product slide">
            @foreach ($comesoon as $movie)
            <div class="col-sm-3 movie-list">
                <div class="movie-info-home">
                    <span class="movie-rating">{{ $movie->rating }}</span>
                    <div class="movie-image">
                        <img class="img-url-movie" src="{{ '/img/' . $movie->url }}" />
                    </div>
                </div>
                <div class="movie-info-detail">
                    <h5 class="movie-name">{{ $movie->title }}</h5>
                    <div class="extra-movie-info">
                        <span class="info-bold">Thể loại:</span>
                        <span class="info-normal">{{ $movie->genres }}</span>
                    </div>
                    <div class="extra-movie-info">
                        <span class="info-bold">Thời lượng:</span>
                        <span class="info-normal">{{ $movie->length }} phút</span>
                    </div>
                    <div class="extra-movie-info">
                        <span class="info-bold">Khởi chiếu:</span>
                        <span class="info-normal">{{ $movie->release_date }}</span>
                    </div>
                    <div class="extra-movie-info">
                        <span class="info-bold">Phụ đề:</span>
                        <span class="info-normal">{{ $movie->subtitle }}</span>
                    </div>
                    <div class="extra-movie-info">
                        <span class="info-bold">Rated:</span>
                        <span class="info-normal">{{ $movie->rating }}</span>
                    </div>
                    <div class="extra-movie-info">
                        <span class="info-bold">Đạo diễn:</span>
                        <span class="info-normal">{{ $movie->director }}</span>
                    </div>
                    <div class="extra-movie-info">
                        <span class="info-bold">Quốc gia:</span>
                        <span class="info-normal">{{ $movie->country }}</span>
                    </div>

                    @if (!Auth::check())
                    <button class="btn-auth">
                        <span class="icon-like fa fa-thumbs-o-up"></span>
                        <span>Like</span>
                    </button>
                    @else
                    @if ($movieObj->checkLike($movie->id))
                    <button type="submit" name="submit-like" class="btn-like liked" data-id="{{ $movie->id }}">
                        <span class="icon-like fa fa-check"></span>
                        <span>Like</span>
                    </button>
                    @else
                    <button type="submit" name="submit-like" class="btn-like unlike" data-id="{{ $movie->id }}">
                        <span class="icon-like fa fa-thumbs-o-up"></span>
                        <span>Like</span>
                    </button>
                    @endif
                    @endif
                    <a href="{{ url('theater/' . $movie->id) }}">
                        <button class="buy-ticket-button">
                            <span>Mua vé</span>
                        </button>
                    </a>
                    <div class = "clear"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script src="{{ asset('js/like_button.js') }}"></script>
<script src="{{ asset('js/slide.js') }}"></script>
@endsection