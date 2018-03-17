@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">THÊM PHIM MỚI</div>
                <div class="panel-body user-info">
                    <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ url('admin/movies/add') }}">
                        <input type='hidden' value="{!! csrf_token() !!}" name='_token' />
                        <div class="form-group user-info-detail">
                            <label for="title" class="col-md-4 control-label">Tên phim</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" >
                            </div>
                        </div>
                        
                        <div class="form-group user-info-detail">
                            <label for="release_date" class="col-md-4 control-label">Ngày khởi chiếu</label>

                            <div class="col-md-6">
                                <input id="release_date" type="date" class="form-control" name="release_date">
                            </div>
                        </div>
                        
                        <div class="form-group user-info-detail">
                            <label for="genres" class="col-md-4 control-label">Thể loại</label>

                            <div class="col-md-6">
                                <input id="genres" type="text" class="form-control" name="genres">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="score" class="col-md-4 control-label">Điểm</label>

                            <div class="col-md-6">
                                <input id="score" type="number" class="form-control" name="score">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="director" class="col-md-4 control-label">Đạo diễn</label>

                            <div class="col-md-6">
                                <input id="director" type="text" class="form-control" name="director">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="country" class="col-md-4 control-label">Quốc gia</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="country">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="length" class="col-md-4 control-label">Thời lượng</label>

                            <div class="col-md-6">
                                <input id="length" type="number" class="form-control" name="length">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="subtitle" class="col-md-4 control-label">Phụ đề</label>

                            <div class="col-md-6">
                                <input id="subtitle" type="text" class="form-control" name="subtitle">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="rating" class="col-md-4 control-label">Giới hạn độ tuổi</label>

                            <div class="col-md-6">
                                <input id="rating" type="text" class="form-control" name="rating">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="file" class="col-md-4 control-label">Poster</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="file" id="file">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    ADD
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
