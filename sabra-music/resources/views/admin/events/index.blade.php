@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="panel">
        <h3>Events Management</h3>
        
        <div class="tabs" style="margin-top:10px">
            <button class="active" data-tab="upcoming-tab">Upcoming</button>
            <button data-tab="past-tab">Past</button>
        </div>
        
        <div style="display:flex; justify-content:flex-end; margin-bottom:12px">
            <a href="{{ route('events.create') }}" class="btn primary">
                <i class="fas fa-plus"></i> Add New Event
            </a>
        </div>
        
        <div class="tab-content" style="margin-top:10px" id="upcoming-tab">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($upcoming_events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</td>
                            <td>{{ $event->location }}</td>
                            <td>
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" style="width:80px;height:40px;object-fit:cover;border-radius:6px"/>
                                @else
                                    <div style="width:80px;height:40px;background:#0b1220;border-radius:6px;display:flex;align-items:center;justify-content:center">
                                        <i class="fas fa-image" style="color:var(--muted)"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span style="padding:3px 8px;border-radius:12px;font-size:12px;
                                    background-color:{{ $event->status == 'draft' ? 'rgba(234,179,8,0.2)' : 'rgba(16,185,129,0.2)' }};
                                    color:{{ $event->status == 'draft' ? '#eab308' : '#10b981' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td>
                                <div style="display:flex; gap:8px">
                                    <a href="{{ route('events.edit', $event->id) }}" class="btn" title="Edit Event">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    @if($event->status == 'draft')
                                        <form action="{{ route('events.publish', $event->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn" title="Publish Event" style="color:#10b981">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('events.draft', $event->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn" title="Save as Draft" style="color:#eab308">
                                                <i class="fas fa-file-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" title="Delete Event" style="color:#ef4444">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:var(--muted);padding:20px">
                                No upcoming events found
                                <div style="margin-top:10px">
                                    <a href="{{ route('events.create') }}" class="btn primary">Create your first event</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="tab-content" style="margin-top:10px;display:none" id="past-tab">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($past_events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</td>
                            <td>{{ $event->location }}</td>
                            <td>
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" style="width:80px;height:40px;object-fit:cover;border-radius:6px"/>
                                @else
                                    <div style="width:80px;height:40px;background:#0b1220;border-radius:6px;display:flex;align-items:center;justify-content:center">
                                        <i class="fas fa-image" style="color:var(--muted)"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span style="padding:3px 8px;border-radius:12px;font-size:12px;
                                    background-color:{{ $event->status == 'draft' ? 'rgba(234,179,8,0.2)' : 'rgba(16,185,129,0.2)' }};
                                    color:{{ $event->status == 'draft' ? '#eab308' : '#10b981' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td>
                                <div style="display:flex; gap:8px">
                                    <a href="{{ route('events.edit', $event->id) }}" class="btn" title="Edit Event">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" title="Delete Event" style="color:#ef4444">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;color:var(--muted);padding:20px">
                                No past events found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tab switching
        document.querySelectorAll('.tabs button').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                this.parentElement.querySelectorAll('button').forEach(b => {
                    b.classList.remove('active');
                });
                
                // Add active class to clicked button
                this.classList.add('active');
                
                // Show the corresponding tab content
                const tabId = this.getAttribute('data-tab');
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.style.display = 'none';
                });
                document.getElementById(tabId).style.display = 'block';
            });
        });
        
        // Confirm delete
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Are you sure you want to delete this event? This action cannot be undone.')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection
