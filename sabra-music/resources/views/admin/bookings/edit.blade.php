@extends('layouts.admin')

@section('content')
<div class="panel">
    <h1>Edit Booking</h1>
    
    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-col">
                <label class="label">User</label>
                <input type="text" class="input" value="{{ $booking->user->name }} ({{ $booking->user->email }})" readonly>
            </div>
            <div class="form-col">
                <label class="label">Created At</label>
                <input type="text" class="input" value="{{ $booking->created_at->format('Y-m-d H:i:s') }}" readonly>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <label class="label">Event Name</label>
                <input type="text" name="purpose" class="input" value="{{ old('purpose', $booking->purpose) }}" required>
            </div>
            <div class="form-col">
                <label class="label">Faculty</label>
                <select name="faculty" class="select" required>
                    <option value="" disabled>Select faculty</option>
                    <option value="Faculty of Computing" {{ old('faculty', $booking->faculty) == 'Faculty of Computing' ? 'selected' : '' }}>Faculty of Computing</option>
                    <option value="Faculty of Geomatics" {{ old('faculty', $booking->faculty) == 'Faculty of Geomatics' ? 'selected' : '' }}>Faculty of Geomatics</option>
                    <option value="Faculty of Social Sciences and Languages" {{ old('faculty', $booking->faculty) == 'Faculty of Social Sciences and Languages' ? 'selected' : '' }}>Faculty of Social Sciences and Languages</option>
                    <option value="Faculty of Agriculture" {{ old('faculty', $booking->faculty) == 'Faculty of Agriculture' ? 'selected' : '' }}>Faculty of Agriculture</option>
                    <option value="Faculty of Management" {{ old('faculty', $booking->faculty) == 'Faculty of Management' ? 'selected' : '' }}>Faculty of Management</option>
                    <option value="Faculty of Technology" {{ old('faculty', $booking->faculty) == 'Faculty of Technology' ? 'selected' : '' }}>Faculty of Technology</option>
                    <option value="Faculty of Medicine" {{ old('faculty', $booking->faculty) == 'Faculty of Medicine' ? 'selected' : '' }}>Faculty of Medicine</option>
                    <option value="Faculty of Applied Science" {{ old('faculty', $booking->faculty) == 'Faculty of Applied Science' ? 'selected' : '' }}>Faculty of Applied Science</option>
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <label class="label">Event Type</label>
                <input type="text" name="event_type" class="input" value="{{ old('event_type', $booking->event_type) }}" required>
            </div>
            <div class="form-col">
                <label class="label">Event Location</label>
                <select name="center_id" class="select" required>
                    <option value="" disabled>Select location</option>
                    @php
                      $allowedCenters = ['Art Center', 'Matta', 'Pnibharatha Open Air Theater', 'Prof J.W. Dyananda Somasundara Auditorium', 'Other'];
                      $addedCenters = [];
                    @endphp
                    @foreach($centers as $center)
                      @if(in_array($center->name, $allowedCenters) && !in_array($center->name, $addedCenters))
                        <option value="{{ $center->id }}" {{ old('center_id', $booking->center_id) == $center->id ? 'selected' : '' }}>{{ $center->name }}</option>
                        @php $addedCenters[] = $center->name; @endphp
                      @endif
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <label class="label">Date</label>
                <input type="date" name="booking_date" class="input" value="{{ old('booking_date', $booking->booking_date) }}" required>
            </div>
            <div class="form-col">
                <label class="label">Status</label>
                <select name="status" class="select" required>
                    <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ old('status', $booking->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ old('status', $booking->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <label class="label">Start Time</label>
                <input type="time" name="start_time" class="input" value="{{ old('start_time', $booking->start_time) }}" required>
            </div>
            <div class="form-col">
                <label class="label">End Time</label>
                <input type="time" name="end_time" class="input" value="{{ old('end_time', $booking->end_time) }}" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <label class="label">Description</label>
                <textarea name="description" class="input" rows="4" style="resize: vertical;">{{ old('description', $booking->description) }}</textarea>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-col">
                <label class="label">PDF Attachment</label>
                @if($booking->pdf_attachment)
                <div style="margin-bottom: 10px;">
                    <a href="{{ route('admin.bookings.pdf', $booking->id) }}" target="_blank" class="btn pdf-view">
                        <i class="fas fa-file-pdf"></i> View Current PDF
                    </a>
                </div>
                @endif
                
                <label class="file-label" id="pdf-label">
                    <i class="fas fa-upload"></i>
                    <span id="pdf-text">{{ $booking->pdf_attachment ? 'Change PDF file' : 'Upload PDF file' }}</span>
                    <input type="file" name="pdf_attachment" class="file-input" id="pdf-input" accept="application/pdf">
                </label>
                <div class="help">Max 10MB. PDF only.</div>
            </div>
        </div>
        
        <div class="form-row" style="margin-top: 20px;">
            <div class="form-col" style="display: flex; gap: 10px;">
                <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn">Cancel</a>
                <button type="submit" class="btn primary">Update Booking</button>
            </div>
        </div>
    </form>
</div>

<script>
    // PDF file input preview
    document.addEventListener('DOMContentLoaded', function() {
        const pdfInput = document.getElementById('pdf-input');
        const pdfLabel = document.getElementById('pdf-label');
        const pdfText = document.getElementById('pdf-text');
        
        pdfInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                pdfLabel.classList.add('has-file');
                pdfText.textContent = this.files[0].name;
            } else {
                pdfLabel.classList.remove('has-file');
                pdfText.textContent = '{{ $booking->pdf_attachment ? 'Change PDF file' : 'Upload PDF file' }}';
            }
        });
    });
</script>
@endsection
