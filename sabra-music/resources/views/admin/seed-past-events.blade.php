@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="panel">
        <h3>Create Test Past Events</h3>
        <p>Use this page to create some example past events for testing the history page.</p>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form action="{{ route('admin.seed-past-events') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Number of past events to create:</label>
                <input type="number" name="count" value="3" min="1" max="10" class="input">
            </div>
            <button type="submit" class="btn primary">Create Test Events</button>
        </form>
    </div>
</div>
@endsection
