@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img class="img-movie-update" src="{{ '/img/user-logo.png' }}">
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">THÔNG TIN NGƯỜI DÙNG</div>

                    <div class="panel-body user-info">
                        <form class="form-horizontal" method="POST" action="{{ url('admin/users/insert') }}">
                            <input type='hidden' value="{!! csrf_token() !!}" name='_token' />
                            <div class="form-group user-info-detail">
                                <label for="email" class="col-md-4 control-label">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email">
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
                                <label for="name" class="col-md-4 control-label">Tên</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="date_of_birth" class="col-md-4 control-label">Ngày sinh</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date" class="form-control" name="date_of_birth">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="account_type" class="col-md-4 control-label">Loại tài khoản</label>

                                <div class="col-md-6">
                                    <input id="account_type" type="text" class="form-control" name="account_type">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="phone" class="col-md-4 control-label">Số điện thoại</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="address" class="col-md-4 control-label">Địa chỉ</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <label for="role" class="col-md-4 control-label">Người dùng/Admin</label>

                                <div class="col-md-6">
                                    <input id="role" type="text" class="form-control" name="role">
                                </div>
                            </div>

                            <div class="form-group user-info-detail">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        INSERT
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

