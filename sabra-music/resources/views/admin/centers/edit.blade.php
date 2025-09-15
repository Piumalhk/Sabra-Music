@extends('layouts.admin')

@section('content')
<div class="panel">
    <h3>Edit Center</h3>
    
    @if($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('centers.update', $center->id) }}" method="POST" enctype="multipart/form-data" style="margin-top:20px">
        @csrf
        @method('PUT')
        
        <div class="form-row">
            <div class="form-col">
                <label class="label">Name</label>
                <select name="name" class="select" required>
                    <option value="" disabled>Select a center</option>
                    <option value="Art Center" {{ $center->name == 'Art Center' ? 'selected' : '' }}>Art Center</option>
                    <option value="Matta" {{ $center->name == 'Matta' ? 'selected' : '' }}>Matta</option>
                    <option value="Pnibharatha Open Air Theater" {{ $center->name == 'Pnibharatha Open Air Theater' ? 'selected' : '' }}>Pnibharatha Open Air Theater</option>
                    <option value="Prof J.W. Dyananda Somasundara Auditorium" {{ $center->name == 'Prof J.W. Dyananda Somasundara Auditorium' ? 'selected' : '' }}>Prof J.W. Dyananda Somasundara Auditorium</option>
                    <option value="Other" {{ $center->name == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                
                <label class="label" style="margin-top:12px">Location</label>
                <input type="text" name="location" class="input" value="{{ old('location', $center->location) }}" required>
                
                <label class="label" style="margin-top:12px">Price per hour ($)</label>
                <input type="number" name="price_per_hour" class="input" step="0.01" min="0" value="{{ old('price_per_hour', $center->price_per_hour) }}" required>
                
                <div style="margin-top:12px">
                    <label class="label">
                        <input type="checkbox" name="is_active" value="1" {{ $center->is_active ? 'checked' : '' }}>
                        Active
                    </label>
                </div>
            </div>
            
            <div class="form-col">
                <label class="label">Cover Image</label>
                <img id="imgPreview" class="img-preview" src="{{ $center->image ? Storage::url($center->image) : asset('images/bg1.jpg') }}" alt="Center image preview">
                <label class="file-label" style="margin-top:8px">
                    <i class="fas fa-upload"></i>
                    <span id="fileLabelText">{{ $center->image ? 'Change image' : 'Upload image' }}</span>
                    <input id="imgInput" name="image" class="file-input" type="file" accept="image/*">
                </label>
                <div class="help">Recommended size: 1200x600px. JPG or PNG.</div>
            </div>
        </div>
        
        <label class="label" style="margin-top:12px">Description</label>
        <textarea name="description" class="input" style="min-height:120px" required>{{ old('description', $center->description) }}</textarea>
        
        <div style="margin-top:20px">
            <button type="submit" class="btn primary">Update Center</button>
            <a href="{{ route('centers.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Image preview
    const imgInput = document.getElementById('imgInput');
    const imgPreview = document.getElementById('imgPreview');
    const fileLabelText = document.getElementById('fileLabelText');
    
    if (imgInput) {
        imgInput.addEventListener('change', (e) => {
            const file = e.target.files && e.target.files[0];
            if (!file) return;
            fileLabelText.innerText = file.name;
            const reader = new FileReader();
            reader.onload = () => imgPreview.src = reader.result;
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection
