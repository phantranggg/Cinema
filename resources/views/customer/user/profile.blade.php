@extends('customer.layouts.app')

@section('content')
<div class="container">
    <div class="row row-content">
        <div class="w3-sidebar w3-bar-block w3-black w3-card col-md-4">
            <h5 class="w3-bar-item">Menu</h5>
            <!--        <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Left')">Left</button>-->
            <button class="w3-bar-item w3-button tablink" onclick="openLink(event, 'Right1')">Thông tin</button>
            <button class="w3-bar-item w3-button tablink" id="bought-ticket" onclick="openLink(event, 'Right2')">Vé đã đặt</button>
        </div>
        <div class="user-right-sidebar col-md-8">
            <div id="Right1" class="w3-container city w3-animate-right" style="display:none">
                <div class="panel panel-default">
                    <div class="panel-heading">THÔNG TIN NGƯỜI DÙNG</div>

                    <div class="panel-body user-info">
                        <form class="form-horizontal" method="POST" action="{{ url('user/update') }}">
                            <input type='hidden' value="{!! csrf_token() !!}" name='_token' />
                            <div class="form-group user-info-detail">
                                <label for="name" class="col-md-4 control-label">Tên</label>

                                <div class="col-md-6">
                                    <div class="form-control">{{ Auth::user()->name }}</div>
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <div class="form-control">{{ Auth::user()->email }}</div>
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm </label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="date_of_birth" class="col-md-4 control-label">Ngày sinh</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" value="{{ Auth::user()->date_of_birth }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="account_type" class="col-md-4 control-label">Loại tài khoản</label>

                                <div class="col-md-6">
                                    <div class="form-control">{{ Auth::user()->account_type }}</div>
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="phone" class="col-md-4 control-label">Số điện thoại</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="address" class="col-md-4 control-label">Địa chỉ</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ Auth::user()->address }}">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="role" class="col-md-4 control-label">Người dùng/Admin</label>

                                <div class="col-md-6">
                                    <div class="form-control">{{ Auth::user()->role }}</div>
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="role" class="col-md-4 control-label"></label>

                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        UPDATE
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="Right2" class="w3-container city w3-animate-right" style="display:none">
                @foreach ($tickets as $info)
                <div class="bill bill-{{ $info->id }}">
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
                        <label>Số ghế: </label>
                        @foreach ($info->tickets as $ticket)
                        <span class="movie-seats inline-block">{{ $ticket->chair_num }}</span>
                        @endforeach
                    </div>
                    @if ($info->invitation)
                    <button type="button" class="btn btn-success">VÉ ĐÔI</button>
                    @else
                    <a href="{{ url('/ticket/modify/' . $info->id ) }}"><button class="btn btn-primary">THAY ĐỔI</button></a>
                    @endif
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal-{{ $info->id }}">XOÁ</button>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal-{{ $info->id }}" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">HUỶ VÉ</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn có muốn huỷ toàn bộ vé của phim này không?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger delete-button-ticket" data-dismiss="modal" data-id="{{ $info->id }}">YES</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/user_profile.js') }}"></script>
@endsection