@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Past Events History</h1>
    
    @if(isset($past_events) && count($past_events) > 0)
        <div class="row">
            @foreach($past_events as $event)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($event->image)
                            <img src="{{ asset('storage/'.$event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}</p>
                            <p class="card-text">{{ $event->location }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            No past events found.
        </div>
    @endif
</div>
@endsection
