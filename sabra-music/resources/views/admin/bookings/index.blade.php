@extends('layouts.admin')

@section('content')
<div class="panel">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <h2 style="margin:0">Manage Bookings</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn">Back to Dashboard</a>
    </div>
    
    <div class="tabs" style="margin-top:10px">
        <button class="active" data-tab="all">All</button>
        <button data-tab="pending">Pending</button>
        <button data-tab="approved">Approved</button>
        <button data-tab="rejected">Rejected</button>
    </div>
    
    <div class="tab-content" style="margin-top:16px">
        <div class="tab-pane active" id="all">
            @include('admin.bookings.partials.booking-table', ['bookings' => $bookings])
        </div>
        <div class="tab-pane" id="pending" style="display:none">
            @include('admin.bookings.partials.booking-table', ['bookings' => $bookings->where('status', 'pending')])
        </div>
        <div class="tab-pane" id="approved" style="display:none">
            @include('admin.bookings.partials.booking-table', ['bookings' => $bookings->where('status', 'approved')])
        </div>
        <div class="tab-pane" id="rejected" style="display:none">
            @include('admin.bookings.partials.booking-table', ['bookings' => $bookings->where('status', 'rejected')])
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching
        const tabButtons = document.querySelectorAll('.tabs button');
        const tabPanes = document.querySelectorAll('.tab-pane');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                tabButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Hide all tab panes
                tabPanes.forEach(pane => pane.style.display = 'none');
                
                // Show the selected tab pane
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).style.display = 'block';
            });
        });
    });
</script>
