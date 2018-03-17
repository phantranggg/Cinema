@extends('layouts.app')

@section('content')
<div class="container">
    <div class="category-title">
        <br /><h1>PHIM SẮP CHIẾU</h1><br />
    </div>
    @php $count = 0; @endphp
    @foreach ($movies as $movie)
        @php $count++; @endphp
        @if ($count%4 === 1)
        <div class="row category-product">
        @endif
        <div class="col-sm-3 movie-list">
            <div class="movie-info">
                <span class="movie-rating">{{ $movie->rating }}</span>
                <div class="movie-image">
                    <img class="img-url-movie" src="{{ '/img/' . $movie->url }}" />
                </div>
                <div action="" method="post" class="movie-info-detail-1">
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
                    <a href="{{ url('theaters/' . $movie->id) }}">
                        <button class="buy-ticket-button">
                            <span>Mua vé</span>
                        </button>
                    </a>
                    <div class = "clear"></div>
                </div>
            </div>
        </div>
        @if ($count%4 === 0 || (count($movies)-$count < 4 && count($movies) === $count))
        </div>
        @endif
    @endforeach
</div>

<script src="{{ asset('js/like_button.js') }}"></script>
@endsection
