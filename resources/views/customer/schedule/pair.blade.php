@extends('customer.layouts.app')

@section('content')
<<<<<<< HEAD
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
				<td class="align-middle">{{ $user->user_info->name }}</td>
				<td class="align-middle">{{ $user->user_info->date_of_birth }}</td>
				<td class="align-middle"><a href="{{ url('schedule/join-pair') }}"><button class="btn btn-primary">Join Pair</button></a></td>
			</tr>
			@endforeach
			<a href="{{ url('schedule/self-add?user_id1='. Auth::id() .'&schedule_id='. $schedule_id) }}">
				<button class="btn btn-success mb-3">Self Adding</button>
			</a>
		</tbody>
	</table>
</div>
=======
<h2>Match</h2>       
  <table class="table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Birthday</th>
        <th>Match</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->user_info->name }}</td>
            <td>{{ $user->user_info->date_of_birth }}</td>
            <td><a href="{{ url('schedule/join-pair') }}">Join Pair</a></td>
            </tr>
        @endforeach
        <a href="{{ url('schedule/self-add?user_id1='. Auth::id() .'&schedule_id='. $schedule_id) }}">Self Adding</a>
    </tbody>
  </table>
>>>>>>> 096dd71c6e7b9ac71ffc2a116846949d23baca3d
@endsection