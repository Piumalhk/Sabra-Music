<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabra Music | History</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --primary: #4A4DE7;
      --primary-light: #6266FF;
      --accent: #FF3C00;
      --accent-light: #FF6B3D;
      --dark: #151424;
      --light: #fff;
      --gray: #8A8AA3;
      --light-gray: #F0F0F5;
      --card-bg: rgba(255,255,255,0.92);
      --gradient-1: linear-gradient(45deg, #4A4DE7, #6266FF);
      --gradient-2: linear-gradient(135deg, #FF3C00, #FF6B3D);
      --shadow-sm: 0 4px 12px rgba(0,0,0,0.08);
      --shadow-md: 0 8px 24px rgba(0,0,0,0.12);
      --shadow-lg: 0 12px 36px rgba(0,0,0,0.18);
      --radius-sm: 8px;
      --radius-md: 16px;
      --radius-lg: 24px;
      --transition: all 0.3s ease;
    }

    body {
      margin: 0;
      font-family: 'Montserrat', Arial, sans-serif;
      background-color: var(--dark);
      background-image: url('{{ asset('images/bg1.jpg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      min-height: 100vh;
      color: var(--light);
      overflow-x: hidden;
    }

    /* Overlay for better text readability */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(to bottom, 
                rgba(21, 20, 36, 0.8), 
                rgba(21, 20, 36, 0.6));
      z-index: -1;
    }

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
      transition: var(--transition);
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
      color: var(--light);
      font-size: 14px;
      font-weight: 600;
      letter-spacing: 1px;
      transition: var(--transition);
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
      background: var(--accent);
      transition: var(--transition);
    }

    .nav-links a:hover {
      color: var(--accent-light);
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    .admin-btn {
      background: var(--primary);
      color: var(--light);
      padding: 10px 24px;
      border-radius: 30px;
      text-decoration: none;
      font-weight: 600;
      font-size: 14px;
      transition: var(--transition);
      border: none;
      cursor: pointer;
      box-shadow: var(--shadow-sm);
    }

    .admin-btn:hover {
      background: var(--primary-light);
      transform: translateY(-3px);
      box-shadow: var(--shadow-md);
    }

    /* Enhanced header with introduction */
    .history-header {
      text-align: center;
      padding: 80px 20px 40px;
      background: var(--gradient-1);
      margin-bottom: 60px;
      clip-path: polygon(0 0, 100% 0, 100% 85%, 50% 100%, 0 85%);
      position: relative;
      overflow: hidden;
    }

    /* Musical note decorations */
    .history-header .note {
      position: absolute;
      font-size: 40px;
      color: rgba(255,255,255,0.2);
      z-index: 1;
      animation: float 8s ease-in-out infinite;
    }

    .history-header .note:nth-child(1) {
      top: 20%;
      left: 10%;
      animation-delay: 0s;
    }

    .history-header .note:nth-child(2) {
      top: 40%;
      right: 15%;
      animation-delay: 2s;
    }

    .history-header .note:nth-child(3) {
      bottom: 20%;
      left: 20%;
      animation-delay: 1s;
    }

    .history-header .note:nth-child(4) {
      top: 30%;
      right: 10%;
      animation-delay: 3s;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.2;
      }
      50% {
        transform: translateY(-20px) rotate(10deg);
        opacity: 0.4;
      }
    }

    .history-title {
      font-size: 36px;
      font-weight: 800;
      margin-bottom: 10px;
      letter-spacing: 2px;
      color: var(--light);
      position: relative;
      z-index: 2;
      text-shadow: 0 2px 10px rgba(0,0,0,0.15);
    }

    .history-subtitle {
      font-size: 18px;
      max-width: 700px;
      margin: 0 auto 30px;
      color: rgba(255,255,255,0.9);
      line-height: 1.6;
      position: relative;
      z-index: 2;
    }

    /* Year filter tabs */
    .year-filter {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
      margin-bottom: 40px;
      position: relative;
      z-index: 2;
    }

    .year-btn {
      background: rgba(255,255,255,0.15);
      border: none;
      color: var(--light);
      padding: 8px 20px;
      border-radius: 30px;
      cursor: pointer;
      transition: var(--transition);
      font-size: 14px;
      font-weight: 500;
    }

    .year-btn:hover, .year-btn.active {
      background: var(--accent);
      transform: translateY(-3px);
      box-shadow: var(--shadow-sm);
    }

    /* Timeline container */
    .history-section {
      padding: 0 40px 60px;
      width: 100%;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
    }

    /* Improved event list */
    .event-list {
      display: flex;
      flex-direction: column;
      gap: 40px;
      align-items: stretch;
      width: 100%;
      max-width: 1000px;
      position: relative;
    }

    /* Timeline vertical line */
    .event-list::before {
      content: "";
      position: absolute;
      left: 120px;
      top: 0;
      bottom: 0;
      width: 3px;
      background: var(--primary);
      background: var(--gradient-1);
      z-index: 0;
      box-shadow: 0 0 10px rgba(74, 77, 231, 0.3);
      border-radius: 3px;
    }

    .event-row {
      display: flex;
      align-items: flex-start;
      gap: 30px;
      width: 100%;
      justify-content: flex-start;
      position: relative;
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }

    .event-row.animate {
      opacity: 1;
      transform: translateY(0);
    }

    /* Enhanced date display */
    .event-date {
      width: 120px;
      min-width: 120px;
      font-size: 18px;
      font-weight: 700;
      color: var(--light);
      letter-spacing: 1px;
      text-align: right;
      padding-right: 20px;
      box-sizing: border-box;
      position: relative;
      z-index: 10;
    }

    .event-date .month {
      display: block;
      font-size: 16px;
      color: var(--primary-light);
      font-weight: 600;
      margin-bottom: 3px;
    }

    .event-date .day {
      display: block;
      font-size: 28px;
      font-weight: 800;
    }

    /* Timeline node */
    .event-row::before {
      content: "";
      display: block;
      position: absolute;
      left: 120px;
      top: 50%;
      transform: translateY(-50%);
      width: 18px;
      height: 18px;
      background: var(--light);
      border-radius: 50%;
      border: 4px solid var(--accent);
      z-index: 2;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 0 10px rgba(255, 60, 0, 0.5);
    }

    .event-row:hover::before {
      transform: translateY(-50%) scale(1.2);
      box-shadow: 0 0 20px rgba(255, 60, 0, 0.8);
    }

    /* Enhanced event card */
    .event-card {
      background: var(--card-bg);
      color: var(--dark);
      border-radius: var(--radius-md);
      display: flex;
      align-items: center;
      padding: 25px 30px;
      gap: 25px;
      flex: 1;
      min-width: 0;
      max-width: none;
      box-shadow: var(--shadow-md);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    /* Subtle accent border on cards */
    .event-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 5px;
      height: 100%;
      background: var(--gradient-2);
      border-radius: var(--radius-md) 0 0 var(--radius-md);
    }

    .event-card:hover {
      transform: translateY(-5px);
      box-shadow: var(--shadow-lg);
    }

    .event-details {
      flex: 1;
      min-width: 0;
    }

    /* Live indicator redesign */
    .event-live {
      color: var(--accent);
      font-weight: 700;
      font-size: 14px;
      margin-bottom: 8px;
      letter-spacing: 1px;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: rgba(255, 60, 0, 0.1);
      padding: 5px 12px;
      border-radius: 20px;
    }

    .event-live-dot {
      display: inline-block;
      width: 8px;
      height: 8px;
      background: var(--accent);
      border-radius: 50%;
      animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
      0% { opacity: 1; transform: scale(1); }
      50% { opacity: 0.5; transform: scale(1.3); }
      100% { opacity: 1; transform: scale(1); }
    }

    .event-title {
      font-size: 22px;
      font-weight: 800;
      margin-bottom: 12px;
      color: var(--dark);
      line-height: 1.3;
    }

    .event-location, .event-faculty {
      font-size: 16px;
      margin-bottom: 8px;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #444;
      font-weight: 500;
    }

    .event-location i, .event-faculty i {
      color: var(--primary);
      font-size: 18px;
      width: 20px;
      text-align: center;
    }

    /* Enhanced event image */
    .event-img {
      width: 180px;
      height: 130px;
      border-radius: var(--radius-sm);
      object-fit: cover;
      background: var(--light-gray);
      flex-shrink: 0;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: var(--shadow-sm);
    }

    .event-card:hover .event-img {
      transform: scale(1.05) rotate(2deg);
      box-shadow: var(--shadow-md);
    }

    /* Empty state styling */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
      background: rgba(255,255,255,0.05);
      border-radius: var(--radius-lg);
      margin: 40px auto;
      max-width: 600px;
      box-shadow: var(--shadow-sm);
    }

    .empty-state i {
      font-size: 48px;
      color: var(--gray);
      margin-bottom: 20px;
      opacity: 0.6;
    }

    .empty-state h3 {
      font-size: 24px;
      color: var(--light);
      margin-bottom: 15px;
    }

    .empty-state p {
      color: var(--gray);
      margin-bottom: 30px;
    }

    /* Main Footer */
    .main-footer {
      background: #111;
      text-align: center;
      padding: 20px;
      font-size: 14px;
      color: #aaa;
    }

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
      color: var(--light);
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

    /* Basic animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-30px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideInRight {
      from { opacity: 0; transform: translateX(30px); }
      to { opacity: 1; transform: translateX(0); }
    }

    /* Scroll to top button */
    .scroll-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: var(--primary);
      color: var(--light);
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      box-shadow: var(--shadow-md);
      opacity: 0;
      transform: translateY(20px);
      transition: var(--transition);
      z-index: 100;
    }

    .scroll-top.visible {
      opacity: 1;
      transform: translateY(0);
    }

    .scroll-top:hover {
      background: var(--primary-light);
      transform: translateY(-5px);
    }

    /* Responsive styles */
    @media (max-width: 1100px) {
      .navbar { padding: 20px 40px; }
      .history-header { padding: 60px 20px 50px; }
      .history-title { font-size: 30px; }
    }

    @media (max-width: 900px) {
      .history-section { padding: 0 20px 40px; }
      .navbar { padding: 15px 20px; }
      .footer-content { justify-content: center; text-align: center; }
      
      .event-card { 
        flex-direction: column; 
        align-items: flex-start; 
        padding: 20px;
      }
      
      .event-img { 
        width: 100%; 
        height: 180px; 
        margin-top: 15px; 
        order: 2; 
      }
      
      .event-row { 
        flex-direction: column; 
        gap: 12px; 
        align-items: stretch; 
      }
      
      .event-date { 
        width: auto; 
        min-width: 0; 
        text-align: left; 
        padding: 0;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
      }
      
      .event-date .month,
      .event-date .day {
        display: inline-block;
        margin: 0;
      }
      
      .event-date .day {
        margin-right: 5px;
      }
      
      .event-list::before, 
      .event-row::before { 
        display: none; 
      }
      
      .scroll-top { 
        bottom: 20px; 
        right: 20px; 
        width: 40px; 
        height: 40px; 
      }
      
      .logo, 
      .auth-section { 
        min-width: 80px; 
      }
      
      .nav-links { 
        gap: 15px;
        margin: 0 10px;
      }
      
      .history-header { 
        clip-path: polygon(0 0, 100% 0, 100% 90%, 50% 100%, 0 90%);
        padding: 50px 20px 70px;
      }
      
      .year-filter {
        margin-top: -40px;
        margin-bottom: 30px;
      }
    }

    @media (max-width: 600px) {
      .history-title { font-size: 28px; }
      .history-subtitle { font-size: 16px; }
      .event-title { font-size: 20px; }
      .nav-links a { font-size: 12px; }
      .event-img { height: 160px; }
      .admin-btn { padding: 8px 16px; font-size: 12px; }
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
      <div class="loading-text">Loading Events...</div>
    </div>
  </div>

  <!-- Scroll to top button -->
  <div class="scroll-top" id="scrollTopBtn">
    <i class="fas fa-arrow-up"></i>
  </div>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <a href="/" class="nav-link">
      <img src="{{ asset('images/Group-237.png') }}" alt="Sabra Music Logo">
      </a>
    </div>
    <div class="nav-links">
      <a href="{{ route('schedule') }}" class="nav-link">SCHEDULE</a>
      <a href="/" class="nav-link">UP COMING</a>
      <a href="{{ route('events.history') }}" class="nav-link">HISTORY</a>
      <a href="#about" class="nav-link">ABOUT</a>
    </div>
    <div class="auth-section">
      @auth
        <a href="{{ route('logout') }}" class="admin-btn nav-link" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          LOGOUT
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      @else
        <a href="{{ route('login') }}" class="admin-btn nav-link">LOGIN</a>
      @endauth
    </div>
  </nav>

  <!-- Enhanced Header Section -->
  <header class="history-header">
    <span class="note">♪</span>
    <span class="note">♫</span>
    <span class="note">♬</span>
    <span class="note">♩</span>
    
    <h1 class="history-title">OUR MUSICAL JOURNEY</h1>
    <p class="history-subtitle">Explore the vibrant history of performances, concerts, and musical events that have shaped our community. Each event tells a unique story of artistic expression and cultural celebration.</p>
    
    <!-- Year filter tabs -->
    <div class="year-filter">
      <button class="year-btn active" data-year="all">All Events</button>
      <button class="year-btn" data-year="2025">2025</button>
      <button class="year-btn" data-year="2024">2024</button>
      <button class="year-btn" data-year="2023">2023</button>
      <button class="year-btn" data-year="archive">Archive</button>
    </div>
  </header>

  <!-- Main content section -->
  <section class="history-section">
    <!-- Debug info (will be removed later) -->
    @php
      $debugAllEvents = \App\Models\Event::where('status', 'published')->get();
      $debugNow = now()->format('Y-m-d');
    @endphp

    <div class="event-list">
      @if(isset($past_events) && count($past_events) > 0)
        @foreach($past_events as $event)
        <div class="event-row" data-year="{{ \Carbon\Carbon::parse($event->event_date)->format('Y') }}">
          <div class="event-date">
            <span class="month">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
            <span class="day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
          </div>
          <div class="event-card">
            <div class="event-details">
              <div class="event-live"><span class="event-live-dot"></span>LIVE PERFORMANCE</div>
              <div class="event-title">{{ $event->title }}</div>
              <div class="event-location"><i class="fas fa-map-marker-alt"></i>{{ $event->location }}</div>
              <div class="event-faculty"><i class="fas fa-music"></i>{{ $event->description }}</div>
            </div>
            @if($event->image)
              <img class="event-img" src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
            @else
              <div class="event-img" style="display:flex;align-items:center;justify-content:center;background:#f0f0f5;">
                <i class="fas fa-music" style="font-size:36px;color:#8A8AA3;"></i>
              </div>
            @endif
          </div>
        </div>
        @endforeach
      @elseif(count($debugAllEvents) > 0)
        <!-- Display all published events if past_events is empty -->
        @foreach($debugAllEvents as $event)
        <div class="event-row" data-year="{{ \Carbon\Carbon::parse($event->event_date)->format('Y') }}">
          <div class="event-date">
            <span class="month">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
            <span class="day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
          </div>
          <div class="event-card">
            <div class="event-details">
              <div class="event-live"><span class="event-live-dot"></span>LIVE PERFORMANCE</div>
              <div class="event-title">{{ $event->title }}</div>
              <div class="event-location"><i class="fas fa-map-marker-alt"></i>{{ $event->location }}</div>
              <div class="event-faculty"><i class="fas fa-music"></i>{{ $event->description }}</div>
            </div>
            @if($event->image)
              <img class="event-img" src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->title }}">
            @else
              <div class="event-img" style="display:flex;align-items:center;justify-content:center;background:#f0f0f5;">
                <i class="fas fa-music" style="font-size:36px;color:#8A8AA3;"></i>
              </div>
            @endif
          </div>
        </div>
        @endforeach
      @else
        <!-- Empty state with better visual styling -->
        <div class="empty-state">
          <i class="fas fa-calendar-xmark"></i>
          <h3>No Past Events Found</h3>
          <p>Check back soon as we add more events to our history.</p>
          <p style="font-size:12px;margin-top:10px;color:#8A8AA3;">Current date: {{ $debugNow }}</p>
          @if(auth()->check() && auth()->user()->is_admin)
            <a href="{{ route('admin.seed-past-events-form') }}" class="admin-btn">
              Create Test Events
            </a>
          @endif
        </div>
      @endif
    </div>
  </section>

  <!-- Enhanced Footer -->
  <footer class="main-footer">
    © 2025 | Sabra Music | All Rights Reserved
  </footer>

  <script>
    // Hide loading overlay when page loads
    document.addEventListener('DOMContentLoaded', function() {
      const loadingOverlay = document.getElementById('loadingOverlay');
      
      // Hide loading overlay after a brief delay for visual effect
      setTimeout(() => {
        loadingOverlay.classList.add('hidden');
      }, 800);
      
      // Set up scroll-based animations
      const eventRows = document.querySelectorAll('.event-row');
      const scrollTopBtn = document.getElementById('scrollTopBtn');
      const yearButtons = document.querySelectorAll('.year-btn');
      
      // Animate elements that are initially in viewport
      checkAndAnimateElements();
      
      // Listen for scroll events to animate elements as they come into view
      window.addEventListener('scroll', function() {
        checkAndAnimateElements();
        toggleScrollTopButton();
      });
      
      // Animate elements when they enter the viewport
      function checkAndAnimateElements() {
        eventRows.forEach(row => {
          if (isElementInViewport(row) && !row.classList.contains('animate')) {
            // Add a slight delay to each subsequent row for a cascade effect
            setTimeout(() => {
              row.classList.add('animate');
            }, 100 * Array.from(eventRows).indexOf(row));
          }
        });
      }
      
      // Check if element is in viewport
      function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
          rect.top <= (window.innerHeight || document.documentElement.clientHeight) * 0.9 &&
          rect.bottom >= 0
        );
      }
      
      // Show/hide scroll-to-top button based on scroll position
      function toggleScrollTopButton() {
        if (window.pageYOffset > 300) {
          scrollTopBtn.classList.add('visible');
        } else {
          scrollTopBtn.classList.remove('visible');
        }
      }
      
      // Scroll to top when button is clicked
      scrollTopBtn.addEventListener('click', function() {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
      
      // Filter events by year
      yearButtons.forEach(btn => {
        btn.addEventListener('click', function() {
          // Update active button
          yearButtons.forEach(b => b.classList.remove('active'));
          this.classList.add('active');
          
          const year = this.getAttribute('data-year');
          
          // Filter events
          eventRows.forEach(row => {
            const rowYear = row.getAttribute('data-year');
            
            if (year === 'all') {
              row.style.display = 'flex';
            } else if (year === 'archive' && parseInt(rowYear) < 2023) {
              row.style.display = 'flex';
            } else if (year === rowYear) {
              row.style.display = 'flex';
            } else {
              row.style.display = 'none';
            }
            
            // Remove animation class to allow re-animation when shown again
            if (row.style.display === 'flex') {
              row.classList.remove('animate');
              setTimeout(() => {
                checkAndAnimateElements();
              }, 100);
            }
          });
        });
      });
      
      // Add music-themed loading animation for page navigation
      const navLinks = document.querySelectorAll('.nav-link');
      
      navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
          // Only show loading for external links (not anchor links)
          if (this.getAttribute('href').startsWith('#')) {
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
    });
  </script>
</body>
</html>
