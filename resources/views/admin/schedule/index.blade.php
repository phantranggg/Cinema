@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="content movie-info-admin">
        <h2>Lịch chiếu</h2>
        <div class="row">
            <div class="col-md-6">
                <p>Tìm theo tên, thể loại, quốc gia,..</p>  
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <br>
            </div>
            <div class="col-md-6">
                <select id="select-theater">
                    <option value="-1">Tất cả</option>
                    @foreach ($theater_name as $name)
                    <option value="{{ $name->id }}" <?php if(isset($theater_id) and $name->id==$theater_id) echo 'selected' ?>>{{ $name->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="changeable_content">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Tên phim</th>
                    <th>Tên rạp</th>
                    <th>Loại vé</th>
                    <th>Giờ chiếu</th>
                    <th>Ngày chiếu</th>
                    <th>Giá</th>
                </tr>
                </thead>
                <tbody id="myTable">
                @foreach ($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->movie->title }}</td>
                        <td>{{ $schedule->theater->name }}</td>
                        <td>{{ $schedule->type }}</td>
                        <td>{{ $schedule->show_time }}</td>
                        <td>{{ $schedule->show_date }}</td>
                        <td>{{ $schedule->price }}</td>
                        <td><a href="{{ url('admin/schedule/show/' . $schedule->id) }}"><button class="btn btn-success">UPDATE</button></a></td>
                        <td><a href="{{ url('admin/schedule/destroy/' . $schedule->id) }}"><button class="btn btn-danger">DELETE</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div >
                {{$schedules->appends(['theater_id'=>$theater_id])->links()}}
            </div>
        </div>

    </div>
</div>

<script src="{{ asset('js/active_sidebar2.js') }}"></script>
@endsection