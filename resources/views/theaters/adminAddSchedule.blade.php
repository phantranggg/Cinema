@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">THÊM LỊCH CHIẾU</div>
                <div class="panel-body user-info">
                    <form class="form-horizontal" method="POST" action="{{ url('admin/schedules/addSche') }}">
                        <input type='hidden' value="{!! csrf_token() !!}" name='_token' />
                        <div class="form-group user-info-detail">
                            <label for="select-theater" class="col-md-4 control-label">Tên rạp</label>

                            <div class="col-md-6">
                                <select name="name" id="select-theater" class="form-control">
                                    @foreach ($theaters as $name)
                                    <option value="{{$name->id}}">{{ $name->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group user-info-detail">
                            <label for="select-movie" class="col-md-4 control-label">Tên phim</label>

                            <div class="col-md-6">
                                <select name="title" id="select-movie" class="form-control">
                                    @foreach ($movies as $title)
                                    <option value="{{$title->id}}">{{ $title->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group user-info-detail">
                            <label for="type" class="col-md-4 control-label">Loại vé</label>

                            <div class="col-md-6">
                                <select name="type" id="type" class="form-control">                                 
                                    <option value="2D">2D</option>   
                                    <option value="3D">3D</option>                              
                                </select>
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="show_time" class="col-md-4 control-label">Giờ chiếu</label>

                            <div class="col-md-6">
                                <input id="show_time" type="time" class="form-control" name="show_time">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="show_date" class="col-md-4 control-label">Ngày chiếu</label>

                            <div class="col-md-6">
                                <input id="show_date" type="date" class="form-control" name="show_date">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="price" class="col-md-4 control-label">Giá vé</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price">
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
