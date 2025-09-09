<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Check Booking • Sabra Music</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
  :root{--bg:#071022;--panel:#0b1220;--muted:#9ca3af;--accent:#10b981}
  body{margin:0;font-family:Inter,Arial,Helvetica,sans-serif;color:#e6eef6;background:linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.55)), url('{{ asset("images/bg1.jpg") }}') center/cover no-repeat;}

  /* center content */
  .wrap{max-width:980px;margin:0 auto;padding:28px;min-height:80vh;display:flex;align-items:center;justify-content:center}

  /* translucent panel with blur */
  .panel{background:rgba(3,6,9,0.55);backdrop-filter:blur(6px);border-radius:14px;padding:28px;border:1px solid rgba(255,255,255,0.04);box-shadow:0 10px 40px rgba(2,6,23,0.6);width:920px}
  h1{margin:0 0 12px;font-size:22px;text-align:center}
    label{display:block;color:var(--muted);font-size:13px;margin-bottom:6px}
    select,input{width:100%;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:#e6eef6}
    .form-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px}
    .controls{display:flex;gap:8px;align-items:center;margin-top:12px}
    .btn{padding:10px 14px;border-radius:8px;border:0;cursor:pointer}
    .btn.primary{background:var(--accent);color:#07221a}
    .result{margin-top:12px;padding:12px;border-radius:8px;background:rgba(255,255,255,0.012);display:flex;justify-content:space-between;align-items:center}
    .badge{padding:6px 10px;border-radius:20px;font-weight:600}
    .badge.ok{background:rgba(16,185,129,0.12);color:var(--accent)}
    .badge.busy{background:rgba(239,68,68,0.08);color:#ef4444}
    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{padding:10px;text-align:left;border-bottom:1px solid rgba(255,255,255,0.03);font-size:14px}
    th{color:var(--muted);font-weight:600}
    .tabs{display:flex;gap:8px;margin-top:12px}
    .tabs button{padding:8px 10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:var(--muted);cursor:pointer}
    .tabs button.active{background:rgba(255,255,255,0.03);color:#fff}
    
    /* Navbar Styles - Matching Schedule Page */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: none;
      padding: 25px 100px;
      height: 60px;
    }

    .logo img {
      height: 50px;
    }

    .nav-links {
      display: flex;
      gap: 40px;
      margin-right: 200px;
    }

    .nav-links a {
      text-decoration: none;
      color: white;
      font-size: 14px;
      letter-spacing: 1px;
    }

    .nav-links a:hover {
      color: #bbb;
    }

    .admin-btn {
      background: white;
      color: black;
      padding: 8px 20px;
      border-radius: 20px;
      text-decoration: none;
      font-weight: bold;
      font-size: 14px;
      transition: background 0.3s ease;
    }

    .admin-btn:hover {
      background: #ddd;
    }
    
    /* Loading Animation - Music Theme */
    .loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.9);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      backdrop-filter: blur(5px);
    }

    .music-loader {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 30px;
    }

    .music-bars {
      display: flex;
      gap: 8px;
      align-items: end;
      height: 50px;
    }

    .bar {
      width: 6px;
      background:white;
      border-radius: 1px;
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
        height: 50px;
        transform: scaleY(1);
      }
    }

    .loading-overlay.show {
      display: flex;
    }
    
    /* Alert Messages */
    .alert{padding:12px 16px;margin-bottom:16px;border-radius:8px;display:flex;align-items:center;gap:12px;font-size:14px}
    .alert-success{background:rgba(16,185,129,0.1);border:1px solid rgba(16,185,129,0.2);color:#10b981}
    .alert-error{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#ef4444}
    
    /* Status Indicators */
    .status{display:inline-block;padding:4px 8px;border-radius:12px;font-size:12px;text-transform:capitalize}
    .status.approved{background:rgba(16,185,129,0.1);color:#10b981}
    .status.pending{background:rgba(234,179,8,0.1);color:#eab308}
    .status.rejected{background:rgba(239,68,68,0.1);color:#ef4444}
    
    /* Action Buttons */
    .action-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 32px;
      height: 32px;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.2s ease;
      background: rgba(255,255,255,0.05);
      color: var(--accent);
    }
    
    .action-btn:hover {
      background: rgba(16,185,129,0.1);
      transform: translateY(-2px);
    }
    
    .action-btn.disabled {
      opacity: 0.5;
      cursor: not-allowed;
      color: var(--muted);
    }
    
    .action-btn.disabled:hover {
      background: rgba(255,255,255,0.05);
      transform: none;
    }
    
    .edit-btn {
      text-decoration: none;
    }
    
    /* Stats Cards */
    .stats{display:flex;gap:12px;margin-bottom:20px}
    .stat-card{flex:1;background:rgba(255,255,255,0.03);border-radius:8px;padding:12px;border:1px solid rgba(255,255,255,0.03)}
    .stat-card .label{color:var(--muted);font-size:12px}
    .stat-card .value{font-size:18px;margin-top:4px;font-weight:600}
    
    @media (max-width:768px){
      .form-grid{grid-template-columns:1fr}
      .stats{flex-direction:column}
      .navbar {padding: 15px 20px;}
      .nav-links {margin-right: 0; gap: 20px;}
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
    </div>
  </div>

  <!-- Navbar -->
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
      @auth
        <a href="{{ route('booking.history') }}" class="nav-link">HISTORY</a>
      @endauth
    </div>

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
  </nav>

  <!-- Success/Error Messages -->
  @if(session('success'))
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-error">
      <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
  @endif

  <div class="wrap">
    <div class="panel">
      <h1>Check Booking Availability</h1>
      <p style="color:var(--muted);margin:6px 0 12px">Pick a center, date and time to see if the slot is available and the current status of bookings.</p>

      <!-- Stats Cards -->
      <div class="stats">
        <div class="stat-card">
          <div class="label">Available Event Location 🏛️</div>
          <div class="value">5</div>
        </div>
        @auth
        <div class="stat-card">
          <div class="label">Your Today's Bookings 📅</div>
          <div class="value">{{ $recentBookings->where('booking_date', date('Y-m-d'))->count() }}</div>
        </div>
        <div class="stat-card">
          <div class="label">Your Total Bookings 🗓️</div>
          <div class="value">{{ $recentBookings->count() }}</div>
        </div>
        @else
        <div class="stat-card">
          <div class="label">Today's Bookings 📅</div>
          <div class="value">-</div>
        </div>
        <div class="stat-card">
          <div class="label">Your Total Bookings 🗓️</div>
          <div class="value">-</div>
        </div>
        @endauth
      </div>

      <div class="form-grid">
        <div>
          <label>Event Location</label>
          <select id="centerSelect">
            <option value="">-- Select Event Location --</option>
            @php
              $allowedCenters = ['Art Center', 'Matta', 'Pnibharatha Open Air Theater', 'Prof J.W. Dyananda Somasundara Auditorium', 'Other'];
              $addedCenters = [];
            @endphp
            @foreach($centers as $center)
              @if(in_array($center->name, $allowedCenters) && !in_array($center->name, $addedCenters))
                <option value="{{ $center->id }}">{{ $center->name }}</option>
                @php $addedCenters[] = $center->name; @endphp
              @endif
            @endforeach
          </select>
        </div>

        <div>
          <label>Date</label>
          <input id="dateInput" type="date" min="{{ date('Y-m-d') }}">
        </div>

        <div>
          <label>Time Range</label>
          <div style="display:flex;gap:8px">
            <input id="startTimeInput" type="time" style="flex:1" placeholder="Start">
            <input id="endTimeInput" type="time" style="flex:1" placeholder="End">
          </div>
        </div>
      </div>

      <div class="controls">
        <button id="checkBtn" class="btn primary"><i class="fas fa-search"></i> Check Availability</button>
        <a href="{{ route('booking.create') }}" class="btn"><i class="fas fa-calendar-plus"></i> Make a Booking</a>
      </div>

      <div id="result" class="result" style="display:none">
        <div>
          <div id="resultText" style="font-weight:700">Available</div>
          <div id="resultSub" style="color:var(--muted);font-size:13px">No conflicting bookings found.</div>
        </div>
        <div id="resultBadge" class="badge ok">Available</div>
      </div>

      <div style="height:8px"></div>

      <div style="display:flex;justify-content:space-between;align-items:center">
        @auth
        <h3 style="margin:0">Your Recent Bookings</h3>
        <div class="tabs" id="statusTabs">
          <button data-filter="all" class="active">All</button>
          <button data-filter="pending">Pending</button>
          <button data-filter="approved">Approved</button>
          <button data-filter="rejected">Rejected</button>
        </div>
        @else
        <h3 style="margin:0">Recent Bookings</h3>
        @endauth
      </div>

      <div style="margin-top:8px;overflow:auto">
        @auth
        <table id="bookingsTable">
          <thead><tr><th>Event Location</th><th>Date</th><th>Time</th><th>Status</th><th>Actions</th></tr></thead>
          <tbody>
            @forelse($recentBookings as $booking)
            <tr class="booking-row" data-status="{{ $booking->status }}">
              <td>{{ $booking->center->name }}</td>
              <td>{{ $booking->booking_date }}</td>
              <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
              <td><span class="status {{ $booking->status }}">{{ $booking->status }}</span></td>
              <td>
                @if($booking->status === 'pending')
                  <a href="{{ route('booking.edit', $booking->id) }}" class="action-btn edit-btn" title="Edit Booking">
                    <i class="fas fa-edit"></i>
                  </a>
                @else
                  <span class="action-btn disabled" title="Only pending bookings can be edited">
                    <i class="fas fa-edit"></i>
                  </span>
                @endif
              </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center;color:var(--muted)">You don't have any bookings yet</td></tr>
            @endforelse
          </tbody>
        </table>
        @else
        <div style="text-align:center;padding:20px;color:var(--muted)">
          <p><i class="fas fa-user-clock"></i> Please <a href="{{ route('login') }}" style="color:var(--accent)">login</a> to view your bookings</p>
        </div>
        @endauth
      </div>
    </div>
  </div>

  <script>
    // Get CSRF token for AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Filter bookings by status
    document.querySelectorAll('#statusTabs button').forEach(btn => {
      btn.addEventListener('click', () => {
        // Update active button
        document.querySelectorAll('#statusTabs button').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        // Filter table rows
        const filter = btn.getAttribute('data-filter');
        const rows = document.querySelectorAll('.booking-row');
        
        rows.forEach(row => {
          if (filter === 'all') {
            row.style.display = 'table-row';
          } else {
            const status = row.getAttribute('data-status');
            row.style.display = status === filter ? 'table-row' : 'none';
          }
        });
      });
    });

    // Check availability
    document.getElementById('checkBtn').addEventListener('click', () => {
      const centerId = document.getElementById('centerSelect').value;
      const date = document.getElementById('dateInput').value;
      const startTime = document.getElementById('startTimeInput').value;
      const endTime = document.getElementById('endTimeInput').value;
      
      // Form validation
      if (!centerId) {
        alert('Please select a center');
        return;
      }
      
      if (!date) {
        alert('Please select a date');
        return;
      }
      
      if (!startTime) {
        alert('Please select a start time');
        return;
      }
      
      if (!endTime) {
        alert('Please select an end time');
        return;
      }
      
      if (startTime >= endTime) {
        alert('End time must be after start time');
        return;
      }
      
      // Show loading state
      const checkBtn = document.getElementById('checkBtn');
      const originalText = checkBtn.innerHTML;
      checkBtn.disabled = true;
      checkBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Checking...';
      
      // Make API request to check availability
      fetch('{{ route("booking.checkAvailability") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
          center_id: centerId,
          date: date,
          start_time: startTime,
          end_time: endTime
        })
      })
      .then(response => response.json())
      .then(data => {
        // Show result
        const result = document.getElementById('result');
        const resultText = document.getElementById('resultText');
        const resultSub = document.getElementById('resultSub');
        const resultBadge = document.getElementById('resultBadge');
        
        if (data.available) {
          resultText.innerText = 'Available';
          resultSub.innerText = 'No conflicting bookings found for this time slot.';
          resultBadge.className = 'badge ok';
          resultBadge.innerHTML = '<i class="fas fa-check-circle"></i> Available';
        } else {
          resultText.innerText = 'Not Available';
          resultSub.innerText = data.message || 'This time slot conflicts with an existing booking.';
          resultBadge.className = 'badge busy';
          resultBadge.innerHTML = '<i class="fas fa-times-circle"></i> Unavailable';
        }
        
        result.style.display = 'flex';
        
        // Reset button state
        checkBtn.disabled = false;
        checkBtn.innerHTML = originalText;
      })
      .catch(error => {
        console.error('Error checking availability:', error);
        alert('An error occurred while checking availability. Please try again.');
        
        // Reset button state
        checkBtn.disabled = false;
        checkBtn.innerHTML = originalText;
      });
    });
    
    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
      document.querySelectorAll('.alert').forEach(alert => {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => alert.style.display = 'none', 500);
      });
    }, 5000);
    
    // Music-themed loading animation for page navigation
    document.addEventListener('DOMContentLoaded', function() {
      const loadingOverlay = document.getElementById('loadingOverlay');
      const navLinks = document.querySelectorAll('.nav-link');

      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          // Only show loading for external links (not anchor links)
          if (this.getAttribute('href').startsWith('#')) {
            return;
          }
          
          e.preventDefault();
          loadingOverlay.classList.add('show');
          
          // Show loading for 1 second to display the music animation
          setTimeout(() => {
            window.location.href = this.getAttribute('href');
          }, 1000);
        });
      });
    });
  </script>
</body>
</html>
