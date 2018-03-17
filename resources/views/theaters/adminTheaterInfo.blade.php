@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">THÔNG TIN RẠP</div>
                <div class="panel-body user-info">
                    <form class="form-horizontal" method="POST" action="{{ url('admin/theaters/update') }}">
                        <input type='hidden' value="{!! csrf_token() !!}" name='_token' />
                        <div class="form-group user-info-detail" style="display: none">
                            <label for="id" class="col-md-4 control-label">ID</label>

                            <div class="col-md-6">
                                <input id="id" type="number" class="form-control" name="id" value="{{ $theater[0]->id }}">
                            </div>
                        </div>
                        <div class="form-group user-info-detail">
                            <label for="name" class="col-md-4 control-label">Tên rạp</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $theater[0]->name }}">
                            </div>
                        </div>
                        
                        <div class="form-group user-info-detail">
                            <label for="hotline" class="col-md-4 control-label">Số điện thoại</label>

                            <div class="col-md-6">
                                <input id="hotline" type="text" class="form-control" name="hotline" value="{{ $theater[0]->hotline }}">
                            </div>
                        </div>
                        
                        <div class="form-group user-info-detail">
                            <label for="row_num" class="col-md-4 control-label">Số hàng</label>

                            <div class="col-md-6">
                                <input id="row_num" type="number" class="form-control" name="row_num" value="{{ $theater[0]->row_num }}">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="column_num" class="col-md-4 control-label">Số cột</label>

                            <div class="col-md-6">
                                <input id="column_num" type="number" class="form-control" name="column_num" value="{{ $theater[0]->column_num }}">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="fax" class="col-md-4 control-label">Fax</label>

                            <div class="col-md-6">
                                <input id="fax" type="text" class="form-control" name="fax" value="{{ $theater[0]->fax }}">
                            </div>
                        </div>

                        <div class="form-group user-info-detail">
                            <label for="address" class="col-md-4 control-label">Địa chỉ</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ $theater[0]->address }}">
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
