@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="panel" style="max-width: 800px; margin: 0 auto;">
        <h3>Event Details</h3>
        
        <div style="margin-top: 15px; background: rgba(255,255,255,0.02); border-radius: 10px; padding: 20px;">
            <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                <div style="flex: 1; min-width: 300px;">
                    <h4 style="margin-top: 0; font-size: 20px;">{{ $event->title }}</h4>
                    
                    <div style="margin-top: 15px;">
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <i class="fas fa-calendar" style="width: 20px; color: var(--accent);"></i>
                            <span style="margin-left: 8px;">{{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y') }}</span>
                        </div>
                        
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <i class="fas fa-clock" style="width: 20px; color: var(--accent);"></i>
                            <span style="margin-left: 8px;">{{ \Carbon\Carbon::parse($event->event_time)->format('g:i A') }}</span>
                        </div>
                        
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <i class="fas fa-map-marker-alt" style="width: 20px; color: var(--accent);"></i>
                            <span style="margin-left: 8px;">{{ $event->location }}</span>
                        </div>
                        
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <i class="fas fa-tag" style="width: 20px; color: var(--accent);"></i>
                            <span style="margin-left: 8px;">
                                <span style="padding:3px 8px;border-radius:12px;font-size:12px;
                                    background-color:{{ $event->status == 'draft' ? 'rgba(234,179,8,0.2)' : 'rgba(16,185,129,0.2)' }};
                                    color:{{ $event->status == 'draft' ? '#eab308' : '#10b981' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </span>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <h5 style="margin-bottom: 10px; color: var(--muted);">Description</h5>
                        <div style="line-height: 1.6;">
                            {{ $event->description }}
                        </div>
                    </div>
                </div>
                
                <div style="width: 300px;">
                    @if($event->image)
                        <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" style="width: 100%; height: auto; border-radius: 10px; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #0b1220 0%, #071022 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="font-size: 40px; color: var(--muted);"></i>
                        </div>
                    @endif
                    
                    <div style="margin-top: 15px; display: flex; gap: 10px;">
                        <a href="{{ route('events.edit', $event->id) }}" class="btn primary" style="flex: 1;">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        
                        @if($event->status == 'draft')
                            <form action="{{ route('events.publish', $event->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn" style="width: 100%; background: rgba(16,185,129,0.1); border-color: rgba(16,185,129,0.2); color: #10b981;">
                                    <i class="fas fa-check-circle"></i> Publish
                                </button>
                            </form>
                        @else
                            <form action="{{ route('events.draft', $event->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn" style="width: 100%;">
                                    <i class="fas fa-file-alt"></i> Draft
                                </button>
                            </form>
                        @endif
                    </div>
                    
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="margin-top: 10px;" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="width: 100%; background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.2); color: #ef4444;">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div style="margin-top: 20px; display: flex; justify-content: space-between;">
            <a href="{{ route('events.index') }}" class="btn">
                <i class="fas fa-arrow-left"></i> Back to Events
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirm delete
        document.querySelector('.delete-form')?.addEventListener('submit', function(e) {
            if (!confirm('Are you sure you want to delete this event? This action cannot be undone.')) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection
