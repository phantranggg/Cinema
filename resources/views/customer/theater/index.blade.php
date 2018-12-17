@extends('customer.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 theater">
            <?php foreach ($theaters as $theater): ?>
                <button class="theater-name" data-id="{{ $theater->id }}">{{ $theater->name }}</button>
            <?php endforeach; ?>
        </div>
        <div class="col-md-12 theater-info-detail"></div>
        @if ($movieId != null) 
        <div class="col-md-12 schedule" data-id1 = "{{ $movieId }}"></div>
        @else
        <div class="col-md-12 schedule"></div>
        @endif
    </div>
</div>

<script src="{{ asset('js/theater_detail.js') }}"></script>
@endsection