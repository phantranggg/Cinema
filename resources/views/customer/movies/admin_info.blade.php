@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img class="img-movie-update" src="{{ '/img/' . $movie->url }}">
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">THÔNG TIN PHIM</div>
                    <div class="panel-body user-info">
                        <form class="form-horizontal" method="POST" action="{{ url('admin/movies/update') }}">
                            <input type='hidden' value="{!! csrf_token() !!}" name='_token' />
                            <div class="form-group user-info-detail" style="display: none">
                                <label for="id" class="col-md-4 control-label">ID</label>

                                <div class="col-md-6">
                                    <input id="id" type="number" class="form-control" name="id" value="{{ $movie->id }}">
                                </div>
                            </div>
                            <div class="form-group user-info-detail">
                                <label for="title" class="col-md-4 control-label">Tên phim</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $movie->title }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="release_date" class="col-md-4 control-label">Khởi chiếu</label>

                                <div class="col-md-6">
                                    <input id="release_date" type="date" class="form-control" name="release_date" value="{{ $movie->release_date }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="genres" class="col-md-4 control-label">Thể loại</label>

                                <div class="col-md-6">
                                    <input id="genres" type="text" class="form-control" name="genres" value="{{ $movie->genres }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="score" class="col-md-4 control-label">Điểm đánh giá</label>

                                <div class="col-md-6">
                                    <input id="score" type="number" class="form-control" name="score" value="{{ $movie->score }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="director" class="col-md-4 control-label">Đạo diễn</label>

                                <div class="col-md-6">
                                    <input id="director" type="text" class="form-control" name="director" value="{{ $movie->director }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="country" class="col-md-4 control-label">Quốc gia</label>

                                <div class="col-md-6">
                                    <input id="country" type="text" class="form-control" name="country" value="{{ $movie->country }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="length" class="col-md-4 control-label">Thời lượng</label>

                                <div class="col-md-6">
                                    <input id="length" type="number" class="form-control" name="length" value="{{ $movie->length }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="subtitle" class="col-md-4 control-label">Phụ đề</label>

                                <div class="col-md-6">
                                    <input id="subtitle" type="text" class="form-control" name="subtitle" value="{{ $movie->subtitle }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="rating" class="col-md-4 control-label">Giới hạn độ tuổi</label>

                                <div class="col-md-6">
                                    <input id="rating" type="text" class="form-control" name="rating" value="{{ $movie->rating }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        UPDATE
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
