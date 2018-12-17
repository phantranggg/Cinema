@extends('customer.layouts.app')

@section('content')
<div class="container">
	<div class="category-title">
		<br /><h1>Match</h1><br />
	</div>
	<table class="table table-bordered">
		<thead class="thead-dark">
			<tr>
				<th>Name</th>
				<th>Birthday</th>
				<th>Match</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td class="align-middle" id="user_id1" data-id="{{ $user->user_id1 }}">{{ $user->user_info->name }}</td>
				<td class="align-middle">{{ $user->user_info->date_of_birth }}</td>
				<td class="align-middle">
					@if (!$users->contains('user_id1', Auth::id()))
					{{-- <a href="{{ url('schedule/join-pair?schedule_id='.$schedule_id.'user_id1='.$user->user_id1) }}"><button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Join Pair</button></a> --}}
					<button class="btn btn-primary" id="join-pair" data-id="{{$schedule_id}}" data-toggle="modal" data-target="#myModal">
						Join Pair
					</button>
					@endif
				</td>
			</tr>
			@endforeach
			@if (!$users->contains('user_id1', Auth::id()))
			<a href="{{ url('schedule/self-add?user_id1='. Auth::id() .'&schedule_id='. $schedule_id) }}">
				<button class="btn btn-success mb-3">Self Adding</button>
			</a>
			@endif
		</tbody>
	</table>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Bạn đã join pair thành công</h4>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/join_pair.js') }}"></script>
@endsection