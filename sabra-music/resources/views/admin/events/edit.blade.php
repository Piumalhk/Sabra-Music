@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="panel" style="max-width: 800px; margin: 0 auto;">
        <h3>Edit Event</h3>
        
        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" style="margin-top:12px">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-col">
                    <label class="label">Title</label>
                    <input class="input" name="title" type="text" placeholder="Event title" required value="{{ old('title', $event->title) }}">

                    <label class="label" style="margin-top:8px">Date</label>
                    <input class="input" name="event_date" type="date" required value="{{ old('event_date', $event->event_date) }}">

                    <label class="label" style="margin-top:8px">Time</label>
                    <input class="input" name="event_time" type="time" required value="{{ old('event_time', $event->event_time) }}">

                    <label class="label" style="margin-top:8px">Location</label>
                    <input class="input" name="location" type="text" placeholder="Location" required value="{{ old('location', $event->location) }}">

                    <label class="label" style="margin-top:8px">Status</label>
                    <select name="status" class="select" required>
                        <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div style="width:220px">
                    <label class="label">Cover Image</label>
                    <img id="imgPreview" class="img-preview" src="{{ $event->image ? Storage::url($event->image) : asset('images/bg1.jpg') }}" alt="image preview">
                    <label class="file-label" style="margin-top:8px">
                        <i class="fas fa-upload"></i>
                        <span id="fileLabelText">{{ $event->image ? 'Change image' : 'Upload image' }}</span>
                        <input id="imgInput" name="image" class="file-input" type="file" accept="image/jpeg,image/png,image/jpg">
                    </label>
                    <button type="button" id="clearImage" style="margin-top:4px;font-size:12px;background:transparent;border:0;color:var(--muted);cursor:pointer;padding:0;{{ !$event->image ? 'display:none;' : '' }}">
                        <i class="fas fa-times"></i> Clear image
                    </button>
                    <div class="help">Recommended size: 1200x600px. JPG or PNG.</div>
                </div>
            </div>

            <label class="label" style="margin-top:10px">Description</label>
            <textarea name="description" class="input" style="min-height:120px" placeholder="Short description" required>{{ old('description', $event->description) }}</textarea>

            <div style="display:flex;gap:8px;margin-top:12px">
                <button type="submit" class="btn primary">Update Event</button>
                <a href="{{ route('admin.dashboard') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imgInput = document.getElementById('imgInput');
        const imgPreview = document.getElementById('imgPreview');
        const fileLabelText = document.getElementById('fileLabelText');
        const clearImageBtn = document.getElementById('clearImage');
        const defaultPreviewSrc = "{{ asset('images/bg1.jpg') }}";
        let hasImageChanged = false;
        
        function updateImagePreview(file) {
            if (!imgPreview) return;
            
            if (file) {
                hasImageChanged = true;
                
                // Update file name display
                fileLabelText.innerText = file.name.length > 20 
                    ? file.name.substring(0, 17) + '...' 
                    : file.name;
                
                // Show image preview
                const reader = new FileReader();
                reader.onload = () => {
                    imgPreview.src = reader.result;
                    imgPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
                
                // Add a class to show file is selected
                document.querySelector('.file-label').classList.add('has-file');
                
                // Show clear button
                if (clearImageBtn) {
                    clearImageBtn.style.display = 'block';
                }
            } else {
                // Reset to default
                imgPreview.src = defaultPreviewSrc;
                fileLabelText.innerText = 'Upload image';
                document.querySelector('.file-label').classList.remove('has-file');
                
                // Add hidden field to indicate image should be removed
                if (hasImageChanged) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'remove_image';
                    hiddenInput.value = '1';
                    imgInput.parentNode.appendChild(hiddenInput);
                }
                
                // Hide clear button
                if (clearImageBtn) {
                    clearImageBtn.style.display = 'none';
                }
            }
        }
        
        if (imgInput) {
            // Handle file selection
            imgInput.addEventListener('change', (e) => {
                const file = e.target.files && e.target.files[0];
                if (!file) return;
                updateImagePreview(file);
            });
            
            // Make sure clicking anywhere on the label opens file dialog
            document.querySelectorAll('.file-label').forEach(lbl => {
                lbl.addEventListener('click', (e) => {
                    // Prevent default if clicking on the input itself
                    if (e.target !== imgInput) {
                        e.preventDefault();
                        imgInput.click();
                    }
                });
            });
            
            // Clear button functionality
            if (clearImageBtn) {
                clearImageBtn.addEventListener('click', () => {
                    // Reset file input
                    imgInput.value = '';
                    updateImagePreview(null);
                });
            }
            
            // Mark as has-file if there's an image
            const currentImage = "{{ $event->image }}";
            if (currentImage) {
                document.querySelector('.file-label').classList.add('has-file');
            }
        }
    });
</script>
@endsection
