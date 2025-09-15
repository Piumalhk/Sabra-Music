<?php use Illuminate\Support\Facades\Auth; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Sabra Music</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #111; 
      background-image: url('{{ asset('images/bg 2.png') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      flex-direction: column;
      color: white;
    }

    /* Navbar - Updated to match history page */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: rgba(21, 20, 36, 0.9);
      backdrop-filter: blur(10px);
      padding: 20px 100px;
      height: 60px;
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

    /* Success Message */
    .success-message {
      background: rgba(16, 185, 129, 0.8);
      color: white;
      padding: 12px 20px;
      border-radius: 8px;
      margin: 0 auto;
      margin-top: 20px;
      max-width: 80%;
      text-align: center;
      animation: fadeOut 5s forwards;
      position: fixed;
      top: 90px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 1000;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    @keyframes fadeOut {
      0% { opacity: 1; }
      70% { opacity: 1; }
      100% { opacity: 0; visibility: hidden; }
    }

    /* Hero Section */
    .hero {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 0 20px;
      margin-top: -50px;
    }

    .hero h1 {
      font-size: 34px;
      font-weight: bold;
      line-height: 1.5;
      max-width: 900px;
    }

    .start-btn {
      background: white;
      color: black;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 16px;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
      margin-top: 50px;
      transition: background 0.3s ease;
    }

    .start-btn:hover {
      background: #ddd;
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
      background: linear-gradient(to top, #FF3C00, #4A4DE7);
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
      <div class="loading-text">Loading Schedule...</div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <a href="/home" class="nav-link">
      <img src="{{ asset('images/Group-237.png') }}" alt="Sabra Music Logo">
      </a>
    </div>

    <div class="nav-links">
      <a href="{{ route('schedule') }}" class="nav-link">SCHEDULE</a>
      <a href="{{ url('/') }}" class="nav-link">UP COMING</a>
      <a href="{{ route('events.history') }}" class="nav-link">HISTORY</a>
      <a href="#" onclick="alert('About page coming soon!'); return false;" class="nav-link">ABOUT</a>
    </div>

    <div class="auth-section">
      @if(Auth::check())
        <span class="admin-btn">{{ Auth::user()->index_no }}</span>
      @else
        <a href="{{ route('admin.login') }}" class="admin-btn">ADMIN</a>
      @endif
    </div>
  </nav>
  
  @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
  @endif

  <!-- Hero Section -->
  <section class="hero">
    <div>
      <h1>
        Easily Reserve Spaces For Your Events, Exhibitions, And Performances. 
        Choose Your Preferred Date, Time, And Venue — 
        And Secure Your Spot At The Art Center In Just A Few Clicks.
      </h1>
      <div style="display:flex;gap:18px;justify-content:center;flex-wrap:wrap;margin-top:50px;">
        <a href="{{ route('booking.create') }}" class="start-btn nav-link">
          <i class="fas fa-calendar-plus" style="margin-right:8px"></i>START BOOKING
        </a>
        <a href="{{ route('booking.check') }}" class="start-btn nav-link" style="background:#10b981;color:#fff;">
          <i class="fas fa-book-check" style="margin-right:8px"></i>CHECK BOOKING
        </a>
      </div>
    </div>
  </section>


<script>
   // Hide loading overlay when page loads
    document.addEventListener('DOMContentLoaded', function() {
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
