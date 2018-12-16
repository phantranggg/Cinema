@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">THÔNG TIN LỊCH CHIẾU</div>
                <div class="panel-body user-info">
                    <form class="form-horizontal" method="POST" action="{{ url('admin/schedules/update') }}">
                        <input type='hidden' value="{!! csrf_token() !!}" name='_token' />
                        <div class="form-group user-info-detail" style="display: none">
                            <label for="id" class="col-md-4 control-label">ID</label>

                            <div class="col-md-6">
                                <input id="id" type="number" class="form-control" name="id" value="{{ $schedule[0]->id }}">
                            </div>
                        </div>
                        <div class="form-group user-info-detail">
                            <label for="select-theater" class="col-md-4 control-label">Tên rạp</label>

                            <div class="col-md-6">
                                <select name="theater_id" id="select-theater" class="form-control">
                                    <option value="{{$schedule[0]->theater_id}}">{{ $schedule[0]->name }}</option>
                                    @foreach ($theaters as $name)
                                    <option value="{{$name->id}}">{{ $name->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group user-info-detail">
                            <label for="select-movie" class="col-md-4 control-label">Tên phim</label>

                            <div class="col-md-6">
                                <select name="movie_id" id="select-movie" class="form-control">
                                    <option value="{{$schedule[0]->movie_id}}">{{ $schedule[0]->title }}</option>
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
                                    <!-- <option value="{{$schedule[0]->type}}">{{$schedule[0]->type}}</option>                               -->
                                    <option value="2D">2D</option>   
                                    <option value="3D">3D</option>                              
                                </select>
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="score" class="col-md-4 control-label">Giờ chiếu</label>

                            <div class="col-md-6">
                                <input id="score" type="time" class="form-control" name="show_time" value="{{$schedule[0]->show_time}}">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="director" class="col-md-4 control-label">Ngày chiếu</label>

                            <div class="col-md-6">
                                <input id="director" type="date" class="form-control" name="show_date" value="{{$schedule[0]->show_date}}">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="country" class="col-md-4 control-label">Giá vé</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="price" value="{{$schedule[0]->price}}">
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
@endsection
