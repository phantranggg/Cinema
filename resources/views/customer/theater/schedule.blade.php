@foreach ($schedule as $movie)
    <div class="row schedule-item">
        <div class="col-md-2 left-side inline-left">
            <img class="img-schedule" src="{{ '/img/' . $movie->url }}">
        </div>
        <div class="col-md-9 right-side inline-left">
            <div class="movie-title-schedule">{{ $movie->title }}</div>
            @foreach ($movie->schedule_detail as $scheduleInfo)
                @if (Auth::check())
                <a href="/theaters/seatmap/{{ $scheduleInfo->id }}">
                @else
                <a href="{{ url('login') }}">
                @endif
                    <div class="schedule-detail-info inline-left">
                        <div class="show_date">Ngày chiếu: {{ $scheduleInfo->show_date }}</div>
                        <div class="show_time">Giờ chiếu: {{ $scheduleInfo->show_time }}</div>
                        <div class="type_schedule">Định dạng: {{ $scheduleInfo->type }}</div>
                        <div class="chair_num">Số ghế trống: {{ $scheduleInfo->totalseat }} ghế</div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="clear"></div>
    </div>
@endforeach


