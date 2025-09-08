@extends('layouts.admin')

@section('content')
<div class="panel">
    <h3>Centers Management</h3>
    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:10px">
        <div style="color:var(--muted)">Manage centers — add, edit or remove centers</div>
        <a href="{{ route('centers.create') }}" class="btn primary">➕ Add Center</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    
    <div style="margin-top:12px;overflow:auto">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($centers as $center)
                    <tr>
                        <td>{{ $center->name }}</td>
                        <td>{{ $center->location }}</td>
                        <td>${{ number_format($center->price_per_hour, 2) }}/hr</td>
                        <td>{{ $center->is_active ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('centers.edit', $center->id) }}" class="btn"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('centers.destroy', $center->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this center?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" style="text-align:center;color:var(--muted)">No centers found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
