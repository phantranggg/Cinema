@foreach ($schedules as $schedule)
<tr>
    <td>{{ $schedule->title }}</td>
    <td>{{ $schedule->name }}</td>
    <td>{{ $schedule->type }}</td>
    <td>{{ $schedule->show_time }}</td>
    <td>{{ $schedule->show_date }}</td>
    <td>{{ $schedule->price }}</td>
    <td><a href="{{ url('admin/schedules/info/' . $schedule->id) }}"><button class="btn btn-success">UPDATE</button></a></td>
    <td><a href="{{ url('admin/schedules/delete/' . $schedule->id) }}"><button class="btn btn-danger">DELETE</button></a></td>
</tr>
@endforeach