@extends('layouts.admin')

@section('content')
<div class="panel">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
        <h2 style="margin:0">Booking Details #{{ $booking->id }}</h2>
        <div>
            <span class="status {{ $booking->status }}">{{ ucfirst($booking->status) }}</span>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;margin-bottom:30px">
        <div>
            <h3>User Information</h3>
            <div style="background:rgba(255,255,255,0.03);border-radius:8px;padding:16px">
                <div style="margin-bottom:10px">
                    <div class="label">Name</div>
                    <div>{{ $booking->user->name }}</div>
                </div>
                <div style="margin-bottom:10px">
                    <div class="label">Email</div>
                    <div>{{ $booking->user->email }}</div>
                </div>
                @if($booking->user->index_no)
                <div style="margin-bottom:10px">
                    <div class="label">Index Number</div>
                    <div>{{ $booking->user->index_no }}</div>
                </div>
                @endif
                <div>
                    <div class="label">Registered</div>
                    <div>{{ $booking->user->created_at->format('Y-m-d') }}</div>
                </div>
            </div>
        </div>
        
        <div>
            <h3>Booking Information</h3>
            <div style="background:rgba(255,255,255,0.03);border-radius:8px;padding:16px">
                <div style="margin-bottom:10px">
                    <div class="label">Event Name</div>
                    <div>{{ $booking->purpose }}</div>
                </div>
                <div style="margin-bottom:10px">
                    <div class="label">Faculty</div>
                    <div>{{ $booking->faculty ?? 'Not specified' }}</div>
                </div>
                <div style="margin-bottom:10px">
                    <div class="label">Event Type</div>
                    <div>{{ $booking->event_type ?? 'Not specified' }}</div>
                </div>
                <div style="margin-bottom:10px">
                    <div class="label">Location</div>
                    <div>{{ $booking->center->name }} ({{ $booking->center->location }})</div>
                </div>
                <div style="margin-bottom:10px">
                    <div class="label">Date & Time</div>
                    <div>{{ $booking->booking_date }} • {{ $booking->start_time }} to {{ $booking->end_time }}</div>
                </div>
                <div>
                    <div class="label">Created</div>
                    <div>{{ $booking->created_at->format('Y-m-d H:i') }}</div>
                </div>
            </div>
        </div>
    </div>

    @if($booking->description)
    <div style="margin-bottom:30px">
        <h3>Description</h3>
        <div style="background:rgba(255,255,255,0.03);border-radius:8px;padding:16px">
            {{ $booking->description }}
        </div>
    </div>
    @endif

    @if($booking->pdf_attachment)
    <div style="margin-bottom:30px">
        <h3>PDF Attachment</h3>
        <a href="{{ route('admin.bookings.pdf', $booking->id) }}" target="_blank" class="btn pdf-view">
            <i class="fas fa-file-pdf"></i> View PDF Document
        </a>
    </div>
    @endif

    <div style="display:flex;gap:12px;margin-top:20px">
        <form action="{{ route('admin.bookings.status', $booking->id) }}" method="POST" style="display:inline">
            @csrf
            @method('PATCH')
            
            @if($booking->status != 'approved')
                <button type="submit" name="status" value="approved" class="btn" style="background:rgba(16,185,129,0.2);border-color:rgba(16,185,129,0.3);color:#10b981">
                    <i class="fas fa-check"></i> Approve
                </button>
            @endif
            
            @if($booking->status != 'rejected')
                <button type="submit" name="status" value="rejected" class="btn" style="background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.2);color:#ef4444">
                    <i class="fas fa-times"></i> Reject
                </button>
            @endif
            
            @if($booking->status != 'pending')
                <button type="submit" name="status" value="pending" class="btn" style="background:rgba(234,179,8,0.1);border-color:rgba(234,179,8,0.2);color:#eab308">
                    <i class="fas fa-clock"></i> Mark Pending
                </button>
            @endif
        </form>
        
        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn primary">
            <i class="fas fa-edit"></i> Edit Booking
        </a>
        
        <a href="{{ route('admin.bookings.index') }}" class="btn">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<style>
    .status {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 13px;
        text-transform: capitalize;
        font-weight: 600;
    }
    .status.approved {
        background: rgba(16,185,129,0.2);
        color: #10b981;
    }
    .status.pending {
        background: rgba(234,179,8,0.1);
        color: #eab308;
    }
    .status.rejected {
        background: rgba(239,68,68,0.1);
        color: #ef4444;
    }
</style>
@endsection
