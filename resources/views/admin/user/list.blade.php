    @extends('layouts.sidebar')

@section('content')
<div class="content-wrapper">
    <div class="content movie-info-admin">
        <h2>Tìm Kiếm Người Dùng</h2>
        <div class="row">
            <div class="col-md-6">
                <p>Tìm theo tên,..</p>  
                <input class="form-control" id="myInput" type="text" placeholder="Search..">
                <br>
            </div>
            <div class="col-md-6">
                <a href="/admin/users/form"><button class="btn btn-basic insert-user">INSERT</button></a>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Ngày sinh</th>
                    <th>Email</th>
                    <th>Điện thoại</th>
                    <th>Status</th>
                    <th>Loại tài khoản</th>
                    <th>Tiền sử dụng</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($users as $user)
                <tr id="user-row-{{ $user->id }}">
                    <td><a href="{{ url('admin/users/info/' . $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{ $user->date_of_birth }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        @if ($user->status)
                            <span class="label label-success">Activated</span>
                        @else
                            <span class="label label-danger">Deactivated</span>
                        @endif
                    </td>
                    <td>{{ $user->account_type }}</td>
                    <td>{{ $user->total_amount }}</td>
                    <td><a href="{{ url('admin/users/info/' . $user->id) }}"><button class="btn btn-success">UPDATE</button></a></td>
                    <td>
                        @if ($user->status)
                            <button class="btn btn-warning deactivate-button-user" userId = "{{ $user->id}}">DEACTIVATE</button>
                        @else
                            <button class="btn btn-primary activate-button-user" userId = "{{ $user->id}}">ACTIVATE</button>
                        @endif
                    </td>
                    <td><button class="btn btn-danger delete-button-user" userId = "{{ $user->id}}">DELETE</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('js/active_sidebar.js') }}"></script>
<script src="{{ asset('js/delete_button.js') }}"></script>
@endsection
