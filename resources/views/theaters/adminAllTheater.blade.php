@extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="content movie-info-admin">
        <h2>Danh sách rạp</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Tên</th>
                    <th>Số điện thoại</th>
                    <th>Số hàng</th>
                    <th>Số cột</th>
                    <th>Fax</th>
                    <th>Địa chỉ</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($theaters as $theater)
                <tr>
                    <td>{{ $theater->id }}</td>
                    <td>{{ $theater->name }}</td>
                    <td>{{ $theater->hotline }}</td>
                    <td>{{ $theater->row_num }}</td>
                    <td>{{ $theater->column_num }}</td>
                    <td>{{ $theater->fax }}</td>
                    <td>{{ $theater->address }}</td>
                    <td><a href="{{ url('admin/theaters/info/' . $theater->id) }}"><button class="btn btn-success">UPDATE</button></a></td>
                    <td><a href="{{ url('admin/theaters/delete/' . $theater->id) }}"><button class="btn btn-danger">DELETE</button></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('js/active_sidebar.js') }}"></script>
@endsection