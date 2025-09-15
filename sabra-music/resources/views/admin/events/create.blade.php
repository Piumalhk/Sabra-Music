@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="panel" style="max-width: 800px; margin: 0 auto;">
        <h3>Create New Event</h3>
        
        @if($errors->any())
            <div class="alert alert-error">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" style="margin-top:12px">
            @csrf
            <div class="form-row">
                <div class="form-col">
                    <label class="label">Title</label>
                    <input class="input" id="evt-title" name="title" type="text" placeholder="Event title" required value="{{ old('title') }}">

                    <label class="label" style="margin-top:8px">Date</label>
                    <input class="input" id="evt-date" name="event_date" type="date" required value="{{ old('event_date') }}">
                    <div class="help">Note: Past dates will appear in the Events History page</div>

                    <label class="label" style="margin-top:8px">Time</label>
                    <input class="input" id="evt-time" name="event_time" type="time" required value="{{ old('event_time') }}">

                    <label class="label" style="margin-top:8px">Location</label>
                    <input class="input" id="evt-location" name="location" type="text" placeholder="Location" required value="{{ old('location') }}">

                    <label class="label" style="margin-top:8px">Status</label>
                    <select id="evt-status" name="status" class="select" required>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div style="width:220px">
                    <label class="label">Cover Image</label>
                    <img id="imgPreview" class="img-preview" src="{{ asset('images/bg1.jpg') }}" alt="image preview">
                    <label class="file-label" style="margin-top:8px">
                        <i class="fas fa-upload"></i>
                        <span id="fileLabelText">Choose image</span>
                        <input id="imgInput" name="image" class="file-input" type="file" accept="image/jpeg,image/png,image/jpg">
                    </label>
                    <button type="button" id="clearImage" style="margin-top:4px;font-size:12px;background:transparent;border:0;color:var(--muted);cursor:pointer;padding:0;display:none;">
                        <i class="fas fa-times"></i> Clear image
                    </button>
                    <div class="help">Recommended size: 1200x600px. JPG or PNG.</div>
                </div>
            </div>

            <label class="label" style="margin-top:10px">Description</label>
            <textarea id="evt-desc" name="description" class="input" style="min-height:120px" placeholder="Short description" required>{{ old('description') }}</textarea>

            <div style="display:flex;gap:8px;margin-top:12px">
                <button type="submit" name="submit_type" value="publish" id="publishBtn" class="btn primary">Publish</button>
                <button type="submit" name="submit_type" value="draft" id="saveDraftBtn" class="btn">Save Draft</button>
                <a href="{{ route('events.index') }}" class="btn">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const createForm = document.querySelector('form');
        const publishBtn = document.getElementById('publishBtn');
        const saveDraftBtn = document.getElementById('saveDraftBtn');
        const imgInput = document.getElementById('imgInput');
        const imgPreview = document.getElementById('imgPreview');
        const fileLabelText = document.getElementById('fileLabelText');
        const clearImageBtn = document.getElementById('clearImage');
        const defaultPreviewSrc = "{{ asset('images/bg1.jpg') }}";
        
        if (publishBtn && saveDraftBtn) {
            // Set Publish button to select published status
            publishBtn.addEventListener('click', function() {
                document.getElementById('evt-status').value = 'published';
            });
            
            // Set Save Draft button to select draft status
            saveDraftBtn.addEventListener('click', function() {
                document.getElementById('evt-status').value = 'draft';
            });
        }
        
        // Form validation
        if (createForm) {
            createForm.addEventListener('submit', function(e) {
                const title = document.getElementById('evt-title').value;
                const date = document.getElementById('evt-date').value;
                const time = document.getElementById('evt-time').value;
                const location = document.getElementById('evt-location').value;
                const description = document.getElementById('evt-desc').value;
                const imageFile = document.getElementById('imgInput').files[0];
                
                // Check required fields
                if (!title || !date || !time || !location || !description) {
                    e.preventDefault();
                    alert('Please fill in all required fields');
                    return;
                }
                
                // Validate image if one is selected
                if (imageFile) {
                    // Check file size (max 5MB)
                    const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                    if (imageFile.size > maxSize) {
                        e.preventDefault();
                        alert('Image file is too large. Maximum size is 5MB.');
                        return;
                    }
                    
                    // Check file type
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!validTypes.includes(imageFile.type)) {
                        e.preventDefault();
                        alert('Invalid file type. Please upload a JPG or PNG image.');
                        return;
                    }
                }
            });
        }
        
        function updateImagePreview(file) {
            if (!imgPreview) return;
            
            if (file) {
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
                fileLabelText.innerText = 'Choose image';
                document.querySelector('.file-label').classList.remove('has-file');
                
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
        }
    });
</script>
@endsection
