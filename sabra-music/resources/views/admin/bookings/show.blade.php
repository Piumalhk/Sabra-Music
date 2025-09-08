@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Booking Details</h1>
    
    <div class="card">
        <div class="card-header">
            <strong>Booking #{{ $booking->id }}</strong>
            <span class="badge badge-{{ $booking->status == 'approved' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }} float-right">
                {{ ucfirst($booking->status) }}
            </span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>User Information</h5>
                    <p><strong>Name:</strong> {{ $booking->user->name }}</p>
                    <p><strong>Email:</strong> {{ $booking->user->email }}</p>
                    <p><strong>Index Number:</strong> {{ $booking->user->index_no }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Booking Details</h5>
                    <p><strong>Center:</strong> {{ $booking->center->name }}</p>
                    <p><strong>Location:</strong> {{ $booking->center->location }}</p>
                    <p><strong>Date:</strong> {{ $booking->booking_date }}</p>
                    <p><strong>Time:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>
                    <p><strong>Price:</strong> ${{ number_format($booking->price, 2) }}</p>
                    <p><strong>Created:</strong> {{ $booking->created_at->format('Y-m-d H:i:s') }}</p>
                </div>
            </div>
            
            <hr>
            
            <div class="row">
                <div class="col-md-12">
                    <h5>Notes</h5>
                    <p>{{ $booking->notes ?? 'No notes provided.' }}</p>
                </div>
            </div>
            
            <!-- PDF Attachment Section -->
            <div class="row">
                <div class="col-md-12">
                    <h5>Attachment</h5>
                    @if($booking->pdf_attachment)
                        <div class="pdf-container">
                            <p>
                                <strong>PDF Document:</strong> 
                                <a href="{{ route('admin.bookings.pdf', $booking->id) }}" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fas fa-file-pdf"></i> View/Download PDF
                                </a>
                            </p>
                            
                            <!-- PDF Embedding (Inline Preview) -->
                            <div style="margin-top: 15px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden; height: 500px;">
                                <object data="{{ route('admin.bookings.pdf', $booking->id) }}" type="application/pdf" width="100%" height="100%">
                                    <p>It appears you don't have a PDF plugin for this browser. 
                                    You can <a href="{{ route('admin.bookings.pdf', $booking->id) }}">click here to download the PDF file</a>.</p>
                                </object>
                            </div>
                        </div>
                    @else
                        <p>No PDF attachment provided for this booking.</p>
                    @endif
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="{{ route('admin.bookings.status', $booking->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        
                        @if($booking->status != 'approved')
                            <button type="submit" name="status" value="approved" class="btn btn-success">
                                Approve Booking
                            </button>
                        @endif
                        
                        @if($booking->status != 'rejected')
                            <button type="submit" name="status" value="rejected" class="btn btn-danger">
                                Reject Booking
                            </button>
                        @endif
                        
                        @if($booking->status != 'pending')
                            <button type="submit" name="status" value="pending" class="btn btn-warning">
                                Mark as Pending
                            </button>
                        @endif
                    </form>
                    
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
