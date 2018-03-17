@extends('layouts.app')

@section('content')
@php $info = $seatmap[0] @endphp
<div class="container">
    <div class="seatmap">
        <div class="row seatmap-show">
            <div class="seatmap-mid inline-left">
                <div class="seatmap-screen">
                    -----------------------MAN HINH------------------------
                </div>
                @for ($row = 1, $c = 'A'; $row <= (int) $info->row_num; $row++, $c++)
                <div class="seatmap-row">
                    @for ($col = 1; $col <= (int) $info->column_num; $col++)
                    @php $status = 'uncheck' @endphp
                    @foreach ($chosenSeat as $chosen)
                    @if ($c.$col == $chosen->chair_num)
                    @php $status = 'chosen' @endphp
                    @endif
                    @endforeach
                    <div class="seat {{ $status }}" data-id1="{{ $c . $col }}" data-id2="{{ $info->id }}">
                        {{ $c . $col }}
                    </div>
                    @endfor
                </div>
                @endfor
            </div>
            <div class="seatmap-legend inline-right">
                <div class="seat-type-icon">
                    <span class="type-icon selected">
                        <span class="icon-box"></span>
                        <span>Đang chọn</span>
                    </span>
                    <span class="type-icon reserved">
                        <span class="icon-box"></span>
                        <span>Đã chọn</span>
                    </span>
                    <span class="type-icon notavail">
                        <span class="icon-box"></span>
                        <span>Không thể chọn</span>
                    </span>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="row seatmap-bottom">

            <a href="{{ url('theaters') }}">
                <button class="process-left-seatmap inline-left">Previous</button>
            </a>
            <div class="movie-cart-info inline-left">
                <div class="ticket-movie-image inline-block">
                    <img class="ticket-image" src="{{ '/img/' . $info->url }}">
                </div>
                <div class="ticket-movie-info inline-block">
                    <span class="ticket-movie-name display-block">
                        <label>Tên phim: </label>{{ $info->title }}
                    </span>
                    <span class="ticket-movie-type display-block">
                        <label>Định dạng: </label>{{ $info->type }}
                    </span>
                </div>
                <div class="ticket-movie-session inline-block">
                    <span class="movie-session-site display-block">
                        <label>Rạp chiếu: </label>{{ $info->name }}
                    </span>
                    <span class="movie-session-date display-block">
                        <label>Ngày chiếu: </label>{{ $info->show_date }}
                    </span>
                    <span class="movie-session-time display-block">
                        <label>Giờ chiếu: </label>{{ $info->show_time }}
                    </span>
                </div>
                <div class="selected-seat inline-block">
                    <div>
                        <label id="chair-num">Số ghế: </label>
                        <span class="movie-seats inline-block"></span>
                    </div>
                    <div>
                        <label>Tổng tiền: </label>
                        <span id="total" data-id4 = "{{ $price }}"></span>
                    </div>
                </div>
            </div>
            <button type="button" id="next" class="process-right-seatmap inline-right">
                Next
            </button>
            <div class="clear"></div>
        </div>
    </div>


    <div class="bill bill-check" style="display:none">
        <div class="bill-row">
            <label>Tên phim: </label>{{ $info->title }}
        </div>
        <div class="bill-row">
            <label>Rạp chiếu: </label>{{ $info->name }}
        </div>
        <div class="bill-row">
            <label>Định dạng: </label>{{ $info->type }}
        </div>
        <div class="bill-row">
            <label>Ngày chiếu: </label>{{ $info->show_date }}
        </div>
        <div class="bill-row">
            <label>Giờ chiếu: </label>{{ $info->show_time }}
        </div>
        <div class="bill-row">
            <label>Số ghế: </label><span class="movie-seats inline-block"></span>
        </div>
        <div class="bill-row">
            <label>Tổng tiền: </label><span id="total-bill"></span>
        </div>

        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="margin-left: 250px">
            Xác nhận
        </button>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bạn đã đặt vé thành công </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/seat_ticket.js') }}"></script>
@endsection