@foreach ($movies as $movie)
<tr>
    <td><a href="{{ url('admin/movies/movieInfo/' . $movie->id) }}"><img class="img-allmovie" src="{{ '/img/' . $movie->url }}"></a></td>
    <td><a href="{{ url('admin/movies/movieInfo/' . $movie->id) }}">{{ $movie->title }}</a></td>
    <td>{{ $movie->genres }}</td>
    <td>{{ $movie->length }} phút</td>
    <td>{{ $movie->release_date }}</td>
    <td>{{ $movie->subtitle }}</td>
    <td>{{ $movie->rating }}</td>
    <td>{{ $movie->director }}</td>
    <td>{{ $movie->country }}</td>
    <td>{{ $movie->like_num }}</td>
    @if ($theaterId != -1)
    <td>{{ $movie->count_ticket }}</td>
    @else 
    <td>{{ $movie->ticket_num }}</td>
    @endif
    <td><a href="{{ url('movie' . $movie->id) }}"><button class="btn btn-success">UPDATE</button></a></td>
    <td><a href=""><button class="btn btn-danger">DELETE</button></a></td>
</tr>
@endforeach
