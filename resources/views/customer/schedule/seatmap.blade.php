@extends('customer.layouts.app')

@section('head')
    <link href="{{ asset('css/seat-style.css') }}" rel="stylesheet">
@endsection

@section('content')
@php $info = $seatmap[0] @endphp
<div class="container">
    {{-- New seat map --}}
    <div class="w3ls-reg">
            <!-- seat availabilty list -->
            <ul class="seat_w3ls">
                <li class="smallBox greenBox">Ghế đã chọn</li>

                <li class="smallBox grayBox">Ghế đã bán</li>

                <li class="smallBox emptyBox">Ghế trống</li>
            </ul>
            <!-- seat availabilty list -->
            <!-- seat layout -->
            <div class="seatStructure txt-center">
                <div class="screen">
                    <h2 class="wthree">MÀN HÌNH</h2>
                </div>
                <table id="seatsBlock">
                    <p id="notification"></p>
                    <tr>
                        <td></td>
                    @for ($col = 1; $col <= (int) $info->column_num; $col++)
                        <td>{{ $col }}</td>
                    @endfor
                    </tr>
                    {{-- Seat code --}}
                    @for ($row = 1, $c = 'A'; $row <= (int) $info->row_num; $row++, $c++)
                        <tr>
                            <td>{{ $c }}</td>
                            @for ($col = 1; $col <= (int) $info->column_num; $col++)
                                @php $status = '' @endphp
                                @foreach ($chosenSeat as $chosen)
                                    @if ($c.$col == $chosen->chair_num)
                                        @php $status = 'disabled' @endphp
                                    @endif
                                @endforeach
                                <td>
                                    <input type="checkbox" class="seats" value="{{ $c . $col }}" data-id1="{{ $c . $col }}" 
                                        data-id2="{{ $info->id }}" {{ $status }}/>
                                </td>
                            @endfor
                        </tr>
                    @endfor
                    {{-- End seat code --}}
                </table>

               
            </div>
            <!-- //seat layout -->
        </div>
    {{-- New seat map --}}

    <div class="seatmap">
        <div class="row seatmap-bottom">
            <a href="javascript:history.back()">
                <button class="process-left-seatmap inline-left btn btn-default">Quay lại</button>
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
            {{-- <button type="button" id="next" class="process-right-seatmap inline-right" data="{{ session('status') }}" disabled>
                Next --}}
            <button type="button" id="next" class="process-right-seatmap inline-right btn btn-primary" data="{{ session('status') }}" disabled>
                Đặt vé
            </button>
            <div class="clear"></div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Bạn đã đặt vé thành công </h4>
                </div>
                <div class="modal-body">
                    <div class="bill bill-check">
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
                    </div>
                </div>
                <form action="{!! url('user/profile') !!}" style="display:none">
                    <input id="redirect" type="submit" value="Go to profile" />
                </form>  
                <div class="modal-footer">
                    <button href="{!! url('user/profile') !!}" id="close-btn" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>  
</div>

<script src="{{ asset('js/seat_ticket.js') }}"></script>
@endsection
