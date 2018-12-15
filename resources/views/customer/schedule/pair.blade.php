@extends('customer.layouts.app')

@section('content')
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
@endsection