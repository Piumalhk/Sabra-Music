<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Center</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>PDF</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user->name }}<br><small style="color:var(--muted);font-size:12px">{{ $booking->user->email }}</small></td>
                <td>{{ $booking->center->name }}</td>
                <td>{{ $booking->booking_date }}</td>
                <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
                <td>
                    <span class="status {{ $booking->status }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
                <td>
                    @if($booking->pdf_attachment)
                        <a href="{{ route('admin.bookings.pdf', $booking->id) }}" class="btn pdf-view" target="_blank" title="View PDF" style="padding:4px 8px">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                    @else
                        <span style="color:var(--muted);font-size:12px">None</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn" style="padding:4px 8px">
                        <i class="fas fa-eye"></i> Details
                    </a>
                    
                    <form action="{{ route('admin.bookings.status', $booking->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('PATCH')
                        
                        @if($booking->status != 'approved')
                            <button type="submit" name="status" value="approved" class="btn" style="padding:4px 8px;background:rgba(16,185,129,0.1);border-color:rgba(16,185,129,0.2);color:#10b981">
                                <i class="fas fa-check"></i>
                            </button>
                        @endif
                        
                        @if($booking->status != 'rejected')
                            <button type="submit" name="status" value="rejected" class="btn" style="padding:4px 8px;background:rgba(239,68,68,0.1);border-color:rgba(239,68,68,0.2);color:#ef4444">
                                <i class="fas fa-times"></i>
                            </button>
                        @endif
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align:center;color:var(--muted)">No bookings found</td>
            </tr>
        @endforelse
    </tbody>
</table>

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
