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
				<th>Address</th>
				<th>Match</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
			<tr>
				<td class="align-middle" id="user_id1" data-id="{{ $user->user_id1 }}">{{ $user->user_info->name }}</td>
				<td class="align-middle">{{ $user->user_info->date_of_birth }}</td>
				<td class="align-middle">{{ $user->user_info->address }}</td>
				<td class="align-middle">
					@if (!$hasUserInPairList && $user->status !== 'JOINED')
					<a href="{{ url('schedule/join-pair?schedule_id='.$scheduleId.'&user_id1='.$user->user_id1) }}">
						<button class="btn btn-primary">JOIN PAIR</button>
					</a>
					{{-- <button class="btn btn-primary" id="join-pair" data-id="{{$schedule_id}}" data-toggle="modal" data-target="#myModal">
						Join Pair
					</button> --}}
					@endif
					@if ($user->status === 'JOINED')
					<button class="btn btn-success">JOINED</button>
					@endif
				</td>
			</tr>
			@endforeach
			@if (!$hasUserInPairList)
			<a href="{{ url('schedule/self-add?user_id1='. Auth::id() .'&schedule_id='. $scheduleId) }}">
				<button class="btn btn-success mb-3">Self Adding</button>
			</a>
			@endif
		</tbody>
	</table>
</div>
@endsection