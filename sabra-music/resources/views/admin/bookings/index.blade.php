@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Bookings</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="all-tab" data-toggle="tab" href="#all">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending">Pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="approved-tab" data-toggle="tab" href="#approved">Approved</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected">Rejected</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="all">
                    @include('admin.bookings.partials.booking-table', ['bookings' => $bookings])
                </div>
                <div class="tab-pane fade" id="pending">
                    @include('admin.bookings.partials.booking-table', ['bookings' => $bookings->where('status', 'pending')])
                </div>
                <div class="tab-pane fade" id="approved">
                    @include('admin.bookings.partials.booking-table', ['bookings' => $bookings->where('status', 'approved')])
                </div>
                <div class="tab-pane fade" id="rejected">
                    @include('admin.bookings.partials.booking-table', ['bookings' => $bookings->where('status', 'rejected')])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#bookingsTable').DataTable({
            order: [[3, 'desc']],
            responsive: true
        });
        
        // Handle tab switching
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endpush
