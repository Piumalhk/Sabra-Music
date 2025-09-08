<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabra Music | History</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #111;
      background-image: url('{{ asset('images/bg1.jpg') }}');
      background-size: cover;
      background-position: right;
      background-repeat: no-repeat;
      min-height: 100vh;
      color: white;
    }
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

    /* Use full viewport width for event content */
    .history-section {
      padding: 60px 40px;
      width: 100%;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .history-title {
      font-size: 22px;
      letter-spacing: 2px;
      margin-bottom: 20px;
      color: #fff;
      font-weight: 400;
      text-align: center;
    }

    /* layout stretches edge-to-edge (within body padding) */
    .event-list {
      display: flex;
      flex-direction: column;
      gap: 40px;
      align-items: stretch;
      width: 100%;
      max-width: none;
      position: relative;
    }

    .event-row {
      display: flex;
      align-items: flex-start;
      gap: 30px;
      width: 100%;
      justify-content: flex-start;
      position: relative;
    }

    /* fixed date column, card stretches across remaining width */
    .event-date {
      width: 120px;
      min-width: 120px;
      font-size: 20px;
      font-weight: bold;
      color: #fff;
      letter-spacing: 1px;
      text-align: right;
      padding-right: 20px;
      box-sizing: border-box;
    }

    .event-card {
      background: rgba(255,255,255,0.95);
      color: #111;
      border-radius: 15px;
      display: flex;
      align-items: center;
      padding: 20px 24px;
      gap: 20px;
      flex: 1;                   /* fill remaining horizontal space */
      min-width: 0;             /* allow shrinking on small screens */
      max-width: none;
      box-shadow: 0 4px 16px rgba(0,0,0,0.10);
    }

    .event-details {
      flex: 1;
      min-width: 0;
    }

    .event-live {
      color: #ff3c00;
      font-weight: bold;
      font-size: 16px;
      margin-bottom: 5px;
      letter-spacing: 1px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .event-live-dot {
      display: inline-block;
      width: 9px;
      height: 9px;
      background: #ff3c00;
      border-radius: 50%;
      margin-right: 6px;
    }
    .event-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #111;
    }
    .event-location, .event-faculty {
      font-size: 16px;
      margin-bottom: 3px;
      display: flex;
      align-items: center;
      gap: 8px;
      color: #222;
      font-weight: 500;
    }

    /* slightly larger images when using full width */
    .event-img {
      width: 160px;
      height: 110px;
      border-radius: 10px;
      object-fit: cover;
      background: #eee;
      flex-shrink: 0;
    }

    /* timeline vertical line aligned with date column */
    .event-list::before {
      content: "";
      position: absolute;
      left: 120px;
      top: 0;
      bottom: 0;
      width: 3px;
      background: rgba(255,255,255,0.18);
      z-index: 0;
    }
    .event-row::before {
      content: "";
      display: block;
      position: absolute;
      left: 120px;
      top: 50%;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
      background: #fff;
      border-radius: 50%;
      border: 4px solid #ff3c00;
      z-index: 2;
    }

    .main-footer {
      background: #111;
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #aaa;
      margin-top: 60px;
    }

    @media (max-width: 900px) {
      .history-section { padding: 40px 16px; }
      .navbar { padding: 20px 10px; }
      .event-card { flex-direction: column; align-items: flex-start; padding: 16px; }
      .event-img { width: 100%; height: 180px; margin-top: 12px; }
      .event-row { flex-direction: column; gap: 12px; align-items: stretch; }
      .event-date { width: auto; min-width: 0; text-align: left; padding-right: 0; }
      .event-list::before, .event-row::before { display: none; }
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <a href="/">
      <img src="{{ asset('images/Group-237.png') }}" alt="Sabra Music Logo">
    </div>
    <div class="nav-links">
      <a href="{{ route('schedule') }}">SCHEDULE</a>
      <a href="/">UP COMING</a>
      <a href="{{ route('events.history') }}">HISTORY</a>
      <a href="#">ABOUT</a>
    </div>
    @auth
      <a href="{{ route('logout') }}" class="admin-btn" 
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        LOGOUT
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    @else
      <a href="{{ route('login') }}" class="admin-btn">LOGIN</a>
    @endauth
  </nav>

  <section class="history-section">
    <div class="history-title">PAST EVENTS</div>

    <!-- Debug info (will be removed later) -->
    @php
      $debugAllEvents = \App\Models\Event::where('status', 'published')->get();
      $debugNow = now()->format('Y-m-d');
    @endphp

    <div class="event-list">
      @if(isset($past_events) && count($past_events) > 0)
        @foreach($past_events as $event)
        <div class="event-row">
          <div class="event-date">{{ $event->formattedDate ?? \Carbon\Carbon::parse($event->event_date)->format('M d') }}</div>
          <div class="event-card">
            <div class="event-details">
              <div class="event-live"><span class="event-live-dot"></span>LIVE</div>
              <div class="event-title">{{ $event->title }}</div>
              <div class="event-location"><i class="fas fa-map-marker-alt"></i>{{ $event->location }}</div>
              <div class="event-faculty"><i class="fas fa-home"></i>{{ $event->description }}</div>
            </div>
            @if($event->image)
              <img class="event-img" src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
            @else
              <div class="event-img" style="display:flex;align-items:center;justify-content:center;background:#eee;">
                <i class="fas fa-image" style="font-size:24px;color:#aaa;"></i>
              </div>
            @endif
          </div>
        </div>
        @endforeach
      @elseif(count($debugAllEvents) > 0)
        <!-- Display all published events if past_events is empty -->
        @foreach($debugAllEvents as $event)
        <div class="event-row">
          <div class="event-date">{{ \Carbon\Carbon::parse($event->event_date)->format('M d') }}</div>
          <div class="event-card">
            <div class="event-details">
              <div class="event-live"><span class="event-live-dot"></span>LIVE</div>
              <div class="event-title">{{ $event->title }}</div>
              <div class="event-location"><i class="fas fa-map-marker-alt"></i>{{ $event->location }}</div>
              <div class="event-faculty"><i class="fas fa-home"></i>{{ $event->description }}</div>
            </div>
            @if($event->image)
              <img class="event-img" src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
            @else
              <div class="event-img" style="display:flex;align-items:center;justify-content:center;background:#eee;">
                <i class="fas fa-image" style="font-size:24px;color:#aaa;"></i>
              </div>
            @endif
          </div>
        </div>
        @endforeach
      @else
        <div style="text-align:center;color:white;margin:40px 0;">
          <p>No past events found</p>
          <p style="font-size:12px;margin-top:20px;color:#aaa;">Current date: {{ $debugNow }}</p>
          @if(auth()->check() && auth()->user()->is_admin)
            <p style="margin-top:20px;">
              <a href="{{ route('admin.seed-past-events-form') }}" style="color:#fff;text-decoration:underline;">
                Create test past events
              </a>
            </p>
          @endif
        </div>
      @endif
    </div>
  </section>

  <footer class="main-footer">
    © 2025 | Sabra Music | All Rights Reserved
  </footer>
</body>
</html>
