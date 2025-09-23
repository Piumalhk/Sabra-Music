<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Edit Booking • Sabra Music</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #0d1b2a;
      background-image: url('{{ asset('images/bg 2.png') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      color: white;
    }

     /* Navbar - Updated to match other pages */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background:none;
      backdrop-filter: blur(10px);
      padding: 20px 100px;
      height: 40px;
      position: sticky;
      top: 0;
      z-index: 1000;
      box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }

    .logo {
      min-width: 100px;
    }

    .logo img {
      height: 50px;
      transition: all 0.3s ease;
    }

    .logo:hover img {
      transform: scale(1.05);
    }
    
    .auth-section {
      min-width: 100px;
      text-align: right;
    }

    .nav-links {
      display: flex;
      gap: 40px;
      margin-left: auto;
      margin-right: auto;
      justify-content: center;
    }

    .nav-links a {
      text-decoration: none;
      color: white;
      font-size: 14px;
      font-weight: 600;
      letter-spacing: 1px;
      transition: all 0.3s ease;
      position: relative;
      padding: 5px 0;
    }

    .nav-links a::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: #FF3C00;
      transition: all 0.3s ease;
    }

    .nav-links a:hover {
      color: #FF6B3D;
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    .admin-btn {
      background: #4A4DE7;
      color: white;
      padding: 10px 24px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .admin-btn:hover {
      background: #6266FF;
      transform: translateY(-3px);
      box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }


    /* Booking Form */
    .form-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 50px 20px;
    }

    .booking-form {
      background: rgba(178, 178, 178, 0.7);
      padding: 40px;
      border-radius: 20px;
      width: 900px;
      max-width: 100%;
      box-shadow: 0 8px 25px rgba(0,0,0,0.6);
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    label {
      display: block;
      font-size: 14px;
      margin-bottom: 20px;
      color: black;
    }

    input, select, textarea {
      width: 90%;
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid black;
      background: rgba(255,255,255,0.1);
      color: white;
      font-size: 14px;
      outline: none;
      box-sizing: border-box;
    }

    input:focus, select:focus, textarea:focus {
      border-color: black;
      background: rgba(255,255,255,0.15);
    }

    textarea {
      resize: none;
      grid-column: span 2;
      height: 100px;
      width: 95%;
    
    }
    input::placeholder,
    textarea::placeholder,
    select option {
    color: #423b3bff; /* Change this to your desired color */
    opacity: 1;
    }  

    select {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      background-image: url("data:image/svg+xml;utf8,<svg fill='white' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
      background-repeat: no-repeat;
      background-position: right 10px center;
      padding-right: 30px; /* Space for the dropdown arrow */
    }

    select, select option {
      color: white;
    }

    select option:first-child {
      color: #423b3bff;
    }

    .submit-btn {
      display: block;
      margin: 20px auto 0; /* center horizontally */
      background: white;
      color: #0d1b2a;
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .cancel-btn {
      display: inline-block;
      margin: 20px 10px 0;
      background: transparent;
      color: white;
      border: 1px solid white;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      text-align: center;
    }

    .submit-btn:hover {
      background: #ddd;
    }

    .cancel-btn:hover {
      background: rgba(255,255,255,0.1);
    }

    .btn-container {
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    /* PDF upload area */
    .pdf-upload {
      margin-top: 18px;
      padding: 14px;
      border-radius: 12px;
      background: rgba(13,27,42,0.12);
      border: 1px dashed rgba(255,255,255,0.06);
      display: flex;
      align-items: center;
      gap: 14px;
      color: #e6eef6;
    }

    .pdf-dropzone{
      flex:1;
      min-height:80px;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:12px;
      text-align:center;
      padding:12px;
      border-radius:10px;
      background:linear-gradient(180deg, rgba(255,255,255,0.01), transparent);
      cursor:pointer;
      transition:background .18s, border-color .18s;
    }

    .pdf-dropzone.dragover{background:rgba(16,185,129,0.06);border-color:rgba(16,185,129,0.3)}

    .pdf-info{display:flex;flex-direction:column;gap:6px;min-width:220px}
    .pdf-info .name{font-weight:600}
    .pdf-info .meta{font-size:13px;color:#cbd5e1}
    .file-remove{background:transparent;border:1px solid rgba(255,255,255,0.06);padding:6px 10px;border-radius:8px;color:#e6eef6;cursor:pointer}

    .hidden-file{display:none}

    /* Loading Animation - Music Theme */
    .loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(21, 20, 36, 0.95);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      backdrop-filter: blur(10px);
      opacity: 1;
      transition: opacity 0.5s ease, visibility 0.5s ease;
    }

    .loading-overlay.hidden {
      opacity: 0;
      visibility: hidden;
    }

    .music-loader {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 30px;
    }

    .loading-text {
      font-size: 18px;
      font-weight: 600;
      color: white;
      letter-spacing: 1px;
      margin-top: 20px;
      opacity: 0.8;
    }

    /* Music Bars Animation */
    .music-bars {
      display: flex;
      gap: 8px;
      align-items: flex-end;
      height: 60px;
    }

    .bar {
      width: 8px;
      background: white;
      border-radius: 4px;
      animation: musicPulse 1.5s ease-in-out infinite;
    }

    .bar:nth-child(1) { animation-delay: 0s; }
    .bar:nth-child(2) { animation-delay: 0.1s; }
    .bar:nth-child(3) { animation-delay: 0.2s; }
    .bar:nth-child(4) { animation-delay: 0.3s; }
    .bar:nth-child(5) { animation-delay: 0.4s; }
    .bar:nth-child(6) { animation-delay: 0.5s; }
    .bar:nth-child(7) { animation-delay: 0.4s; }
    .bar:nth-child(8) { animation-delay: 0.3s; }
    .bar:nth-child(9) { animation-delay: 0.2s; }
    .bar:nth-child(10) { animation-delay: 0.1s; }

    @keyframes musicPulse {
      0%, 40%, 100% {
        height: 20px;
        transform: scaleY(0.4);
      }
      20% {
        height: 60px;
        transform: scaleY(1);
      }
    }

    .loading-overlay.show {
      display: flex;
    }

    .modal-content {
      background: rgba(13, 27, 42, 0.95);
      padding: 30px;
      border-radius: 15px;
      max-width: 500px;
      text-align: center;
      box-shadow: 0 5px 20px rgba(0,0,0,0.3);
      position: relative;
      border: 1px solid rgba(255,255,255,0.1);
      animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
      from {opacity: 0; transform: translateY(-20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .modal-title {
      font-size: 24px;
      margin-bottom: 15px;
      color: #ef4444;
    }

    .modal-message {
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .modal-buttons {
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .modal-button {
      padding: 10px 25px;
      border-radius: 25px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.2s;
      border: none;
    }

    .modal-button.primary {
      background: white;
      color: #0d1b2a;
    }

    .modal-button.secondary {
      background: transparent;
      color: white;
      border: 1px solid rgba(255,255,255,0.3);
    }

    .modal-button:hover {
      transform: translateY(-2px);
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    /* Alert Messages */
    .alert {
      padding: 12px 15px;
      margin: 15px 0;
      border-radius: 8px;
      font-size: 14px;
    }

    .alert-error {
      background-color: rgba(239, 68, 68, 0.15);
      color: #ef4444;
      border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .alert-success {
      background-color: rgba(16, 185, 129, 0.15);
      color: #10b981;
      border: 1px solid rgba(16, 185, 129, 0.3);
    }

    /* Page title */
    .page-title {
      text-align: center;
      margin-top: 20px;
      color: white;
      font-size: 28px;
      font-weight: bold;
    }

    .page-subtitle {
      text-align: center;
      color: rgba(255,255,255,0.7);
      margin-bottom: 30px;
    }
  </style>
</head>
<body>

  <!-- Loading Overlay -->
  <div class="loading-overlay" id="loadingOverlay">
    <div class="music-loader">
      <!-- Music Bars -->
      <div class="music-bars">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>
      <div class="loading-text">Updating Booking...</div>
    </div>
  </div>
  <nav class="navbar">
    <div class="logo">
      <a href="{{ url('/home') }}" class="nav-link">
        <img src="{{ asset('images/Group-237.png') }}" alt="Sabra Music Logo">
      </a>
    </div>

    <div class="nav-links">
      <a href="{{ route('booking.create') }}" class="nav-link">BOOK</a>
      <a href="{{ route('booking.check') }}" class="nav-link">CHECK</a>
      <a href="{{ route('schedule') }}" class="nav-link">SCHEDULE</a>
      <a href="{{ route('booking.history') }}" class="nav-link">HISTORY</a>
    </div>

    <div class="auth-section">
      @auth
        @if(Auth::user()->role === 'admin')
          <a href="{{ route('admin.dashboard') }}" class="admin-btn nav-link">ADMIN</a>
        @else
          <form action="{{ route('logout') }}" method="POST" style="display:inline;margin:0">
            @csrf
            <button type="submit" class="admin-btn">LOGOUT</button>
          </form>
        @endif
      @else
        <a href="{{ route('login') }}" class="admin-btn nav-link">LOGIN</a>
      @endauth
    </div>
  </nav>

  <h1 class="page-title">Edit Booking</h1>
  <p class="page-subtitle">Update your booking details below</p>

  <!-- Booking Form Section -->
  <div class="form-container">
    <form class="booking-form" action="{{ route('booking.update', $booking->id) }}" method="POST" enctype="multipart/form-data" id="bookingForm">
      @csrf
      @method('PUT')
      
      @if(session('error'))
        <div class="alert alert-error">
          {{ session('error') }}
        </div>
      @endif
      
      @if($errors->any())
        <div class="alert alert-error">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      
      <div class="form-grid">
        <div>
          <label>Event Name</label>
          <input type="text" name="purpose" placeholder="Name" required value="{{ old('purpose', $booking->purpose) }}">
        </div>
        <div>
          <label>Faculty</label>
          <select name="faculty" style="color: white;" required>
            <option value="" disabled style="color: #423b3bff;">Select your faculty</option>
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

        <div>
          <label>Event Type</label>
          <input type="text" name="event_type" placeholder="Event Type" required value="{{ old('event_type', $booking->event_type) }}">
        </div>
        <div>
          <label>Event Location</label>
          <select name="center_id" required>
            <option value="" disabled style="color: #423b3bff;">Select a venue</option>
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

        <div>
          <label>Email</label>
          <input type="email" name="email" placeholder="Email" value="{{ Auth::user()->email }}" readonly>
        </div>
        <div>
          <label>Date</label>
          <input type="date" name="booking_date" id="booking_date" placeholder="Select date" style="color:white;" required value="{{ old('booking_date', $booking->booking_date) }}">
        </div>

        <div>
          <label>Start Time</label>
          <input type="time" name="start_time" id="start_time" placeholder="Select time" style="color:white;" required value="{{ old('start_time', $booking->start_time) }}">
        </div>
        <div>
          <label>End Time</label>
          <input type="time" name="end_time" id="end_time" placeholder="Select time" style="color:white;" required value="{{ old('end_time', $booking->end_time) }}">
        </div>
      </div>

      <div>
        <label style="margin-top: 20px;">Description</label>
        <textarea name="description" placeholder="Type Here">{{ old('description', $booking->description) }}</textarea>
      </div>

      <!-- PDF upload area -->
      <div class="pdf-upload">
        <div id="dropzone" class="pdf-dropzone">
          <div style="display:flex;flex-direction:column;align-items:center">
            <i class="fas fa-file-pdf" style="font-size:28px;color:#ef4444"></i>
            <div style="margin-top:6px">Drag & drop a PDF here or <span style="text-decoration:underline">browse</span></div>
            <div style="font-size:12px;color:#cbd5e1;margin-top:6px">Max 10MB · PDF only</div>
          </div>
          <input id="pdfInput" name="pdf_attachment" class="hidden-file" type="file" accept="application/pdf">
        </div>

        <div class="pdf-info" id="pdfInfo">
          <div class="name">{{ $booking->pdf_attachment ? 'Current file: PDF Attachment' : 'No file selected' }}</div>
          <div class="meta">{{ $booking->pdf_attachment ? 'You can upload a new PDF to replace the current one' : 'Upload a PDF with supporting documents (rider, schedule, proposal)' }}</div>
          <div style="display:flex;gap:8px;margin-top:8px">
            <button id="removeFile" class="file-remove" type="button" style="display:none">Remove</button>
            <button id="changeFile" class="file-remove" type="button" style="display:{{ $booking->pdf_attachment ? 'inline-block' : 'none' }}">Change</button>
          </div>
        </div>
      </div>

      <div class="btn-container">
        <a href="{{ route('booking.check') }}" class="cancel-btn">Cancel</a>
        <button type="submit" class="submit-btn" id="submitBtn">Update Booking</button>
      </div>
    </form>
  </div>

  <script>
    // File Upload Handling
    (function(){
      const dropzone = document.getElementById('dropzone');
      const pdfInput = document.getElementById('pdfInput');
      const pdfInfo = document.getElementById('pdfInfo');
      const removeBtn = document.getElementById('removeFile');
      const changeBtn = document.getElementById('changeFile');

      function showFile(file){
        pdfInfo.querySelector('.name').innerText = file.name;
        pdfInfo.querySelector('.meta').innerText = Math.round(file.size/1024) + ' KB · ' + file.type;
        removeBtn.style.display = 'inline-block';
        changeBtn.style.display = 'inline-block';
      }

      function clearFile(){
        pdfInput.value = '';
        pdfInfo.querySelector('.name').innerText = 'No file selected';
        pdfInfo.querySelector('.meta').innerText = 'Upload a PDF with supporting documents (rider, schedule, proposal)';
        removeBtn.style.display = 'none';
        changeBtn.style.display = 'none';
      }

      dropzone.addEventListener('click', ()=> pdfInput.click());

      dropzone.addEventListener('dragover', (e)=>{ e.preventDefault(); dropzone.classList.add('dragover'); });
      dropzone.addEventListener('dragleave', (e)=>{ e.preventDefault(); dropzone.classList.remove('dragover'); });
      dropzone.addEventListener('drop', (e)=>{
        e.preventDefault(); dropzone.classList.remove('dragover');
        const file = e.dataTransfer.files && e.dataTransfer.files[0];
        handleFile(file);
      });

      pdfInput.addEventListener('change', (e)=>{
        const file = e.target.files && e.target.files[0];
        handleFile(file);
      });

      removeBtn.addEventListener('click', clearFile);
      changeBtn.addEventListener('click', ()=> pdfInput.click());

      function handleFile(file){
        if (!file) return;
        if (file.type !== 'application/pdf') { alert('Please upload a PDF file.'); return; }
        if (file.size > 10 * 1024 * 1024) { alert('File too large. Max is 10MB.'); return; }
        showFile(file);
      }
    })();

    // Booking Availability Check
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('bookingForm');
      const submitBtn = document.getElementById('submitBtn');
      const modal = document.getElementById('unavailableModal');
      const closeModalBtn = document.getElementById('closeModalBtn');
      const checkAvailabilityBtn = document.getElementById('checkAvailabilityBtn');
      const loadingOverlay = document.getElementById('loadingOverlay');
      
      // Hide loading overlay after a brief delay for visual effect
      setTimeout(() => {
        loadingOverlay.classList.add('hidden');
      }, 800);
      
      // Add music-themed loading animation for page navigation
      const navLinks = document.querySelectorAll('.nav-link');
      
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          // Only show loading for external links (not anchor links)
          if (this.getAttribute('href') && this.getAttribute('href').startsWith('#')) {
            return;
          }
          
          e.preventDefault();
          loadingOverlay.classList.remove('hidden');
          
          // Show loading for 1 second to display the music animation
          setTimeout(() => {
            window.location.href = this.getAttribute('href');
          }, 800);
        });
      });
      
      // Close modal button event
      closeModalBtn.addEventListener('click', function() {
        modal.style.display = 'none';
      });
      
      // Redirect to availability check page
      checkAvailabilityBtn.addEventListener('click', function() {
        window.location.href = "{{ route('booking.check') }}";
      });
      
      // Form submission handler
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const centerId = document.querySelector('select[name="center_id"]').value;
        const bookingDate = document.getElementById('booking_date').value;
        const startTime = document.getElementById('start_time').value;
        const endTime = document.getElementById('end_time').value;
        
        // Check for empty required fields
        if (!centerId || !bookingDate || !startTime || !endTime) {
          alert('Please fill in all required fields');
          return;
        }
        
        // Check if end time is after start time
        if (endTime <= startTime) {
          alert('End time must be after start time');
          return;
        }
        
        // Check availability before submitting (excluding current booking)
        checkAvailability(centerId, bookingDate, startTime, endTime, function(isAvailable) {
          if (isAvailable) {
            // Show loading overlay before submitting
            loadingOverlay.classList.remove('hidden');
            setTimeout(() => {
              form.submit(); // Submit the form if slot is available
            }, 300);
          } else {
            // Show unavailable modal
            modal.style.display = 'flex';
          }
        });
      });
      
      // Function to check availability
      function checkAvailability(centerId, date, startTime, endTime, callback) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch("{{ route('booking.checkAvailability') }}", {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({
            center_id: centerId,
            date: date,
            start_time: startTime,
            end_time: endTime,
            exclude_booking_id: {{ $booking->id }} // Exclude current booking from check
          })
        })
        .then(response => response.json())
        .then(data => {
          callback(data.available);
        })
        .catch(error => {
          console.error('Error checking availability:', error);
          // Default to allowing submission if check fails
          callback(true);
        });
      }
    });
  </script>
</body>
</html>
