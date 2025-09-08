<div class="table-responsive">
    <table class="table table-hover" id="bookingsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Center</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Attachment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }}<br><small>{{ $booking->user->email }}</small></td>
                    <td>{{ $booking->center->name }}</td>
                    <td>{{ $booking->booking_date }}</td>
                    <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                    <td>
                        <span class="badge badge-{{ $booking->status == 'approved' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        @if($booking->pdf_attachment)
                            <a href="{{ route('admin.bookings.pdf', $booking->id) }}" class="btn btn-sm btn-outline-primary" target="_blank" title="View PDF">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        @else
                            <span class="text-muted">None</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> View
                        </a>
                        
                        <form action="{{ route('admin.bookings.status', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            
                            @if($booking->status != 'approved')
                                <button type="submit" name="status" value="approved" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i>
                                </button>
                            @endif
                            
                            @if($booking->status != 'rejected')
                                <button type="submit" name="status" value="rejected" class="btn btn-sm btn-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No bookings found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
