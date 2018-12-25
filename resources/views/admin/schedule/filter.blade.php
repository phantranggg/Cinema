
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
    <td>{{$schedule->movie->title }}</td>
    <td>{{ $schedule->theater->name}}</td>
    <td>{{ $schedule->type }}</td>
    <td>{{ $schedule->show_time }}</td>
    <td>{{ $schedule->show_date }}</td>
    <td>{{ $schedule->price }}</td>
    <td><a href="{{ url('admin/schedules/info/' . $schedule->id) }}"><button class="btn btn-success">UPDATE</button></a></td>
    <td><a href="{{ url('admin/schedules/delete/' . $schedule->id) }}"><button class="btn btn-danger">DELETE</button></a></td>
</tr>
@endforeach
    </tbody>
</table>
{{--<h1>{{$theater_id}}</h1>--}}
<div >
    {{$schedules->appends(['theater_id'=>$theater_id])->links()}}

</div>