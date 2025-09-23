<?php
use Carbon\Carbon;

// navbar.php (Laravel Blade style with PHP)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabra Music</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  

  <style>
    :root{--accent1:#ff7a18;--accent2:#ff3d6b;--accent3:#6b8bff;--accent4:#00e0ff;--muted:#bbb}
    /* Colorful theme tweaks for Home page */
    .colorful-accent{transition:all .18s ease}
    
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #111; 
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      color: white;
      scroll-behavior: smooth;
      overflow-x: hidden;
    }

    /* Navbar - Updated to match history page */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: none;
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
      background: #ffffff;
      color: rgb(0, 0, 0);
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

    /* Hero Section */
    .hero {
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      padding: 0 110px;
      width: 100vw;
      height: 100vh;
      min-height: 100vh;
      background-image: url("{{ asset('images/bg1.jpg') }}");
      background-size:cover;
      background-position:center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      overflow:hidden;
    }

    /* Optional: Add overlay for better text readability */
    .hero::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.3);
      z-index: 1;
    }

    /* Ensure hero content appears above overlay */
    .hero > * {
      position: relative;
      z-index: 2;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .hero {
        padding: 0 40px;
        text-align: center;
        align-items: center;
      }
      
      .hero h1 {
        font-size: 48px;
      }
    }

    @media (max-width: 480px) {
      .hero {
        padding: 0 20px;
      }
      
      .hero h1 {
        font-size: 36px;
      }
    }

    .hero small {
      display: inline-block;
      font-size: 14px;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #fff;
      background: linear-gradient(90deg, rgba(255,255,255,0.04), rgba(255,255,255,0.02));
      padding: 8px 14px;
      border-radius: 999px;
      border: 1px solid rgba(255,255,255,0.06);
      box-shadow: 0 8px 18px rgba(0,0,0,0.45);
      position: relative;
      z-index: 4;
      font-weight: 700;
    }

    /* subtle gradient lines either side of the small headline */
    .hero small::before,
    .hero small::after {
      content: '';
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 36px;
      height: 2px;
      
      opacity: 0.9;
      border-radius: 2px;
    }
    .hero small::before { left: -46px; }
    .hero small::after { right: -46px; }

    .hero h1 {
      font-size: 60px;
      font-weight: 800;
      margin: 20px 0;
      line-height: 1.05;
      letter-spacing: -0.5px;
      /* animated gradient text */
      background: linear-gradient(90deg, var(--accent1), var(--accent2), var(--accent3), var(--accent4));
      background-size: 300% 100%;
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
      text-shadow: 0 6px 18px rgba(0,0,0,0.35);
      animation: gradientShift 8s linear infinite;
      transition: transform .6s ease;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .title-hero{
      display: inline;
      font-size: 24px;
    }
    .hero .hero-sub {
      margin-top: 12px;
      font-size: 14px;
      color: rgba(255,255,255,0.95);
      max-width: 620px;
      line-height: 1.5;
      opacity: 0.98;
      padding: 12px 18px;
      border-radius: 12px;
      background: linear-gradient(90deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
      border-left: 4px solid;
      border-image: linear-gradient(180deg, var(--accent2), var(--accent4)) 1;
      box-shadow: 0 10px 30px rgba(0,0,0,0.45);
      display: inline-block;
      align-items: center;
      text-align: justify;
    }

    .hero .hero-sub::before {
      content: '♪';
      display: inline-block;
      margin-right: 10px;
      color: var(--accent2);
      font-weight: 800;
      background: rgba(255,255,255,0.03);
      padding: 6px 8px;
      border-radius: 8px;
      box-shadow: 0 6px 14px rgba(0,0,0,0.4);
    }

    .floating-notes {
      position: absolute;
     left: 720px;
      top: 100px;
      pointer-events: none;
      z-index: 5;
    }
    .floating-notes .note {
      color: rgba(255,255,255,0.95);
      font-size: 40px;
      opacity: 0.9;
      transform: translateY(0);
      display:inline-block;
    }
    .floating-notes .note.n1 { animation: floatUp 4.5s ease-in-out infinite; margin-right:6px; }
    .floating-notes .note.n2 { animation: floatUp 5.4s ease-in-out infinite; margin-right:6px; }
    .floating-notes .note.n3 { animation: floatUp 6.2s ease-in-out infinite; }

    @keyframes floatUp {
      0% { transform: translateY(0); opacity: 0.9; }
      50% { transform: translateY(-18px); opacity: 0.6; }
      100% { transform: translateY(0); opacity: 0.9; }
    }

    .hero h1 .accent { display: inline-block; }
    .hero a.signup-btn, .hero a.login-btn { transform-origin: center; }
    .hero a.signup-btn:hover { transform: translateY(-4px) scale(1.02); }

    /* Respect user's reduced motion preference */
    @media (prefers-reduced-motion: reduce) {
      .hero h1 { animation: none !important; }
      .floating-notes .note { animation: none !important; }
    }
    .button-row{
      display: flex;
      gap: 20px;
      margin-top: 30px;
    }
    .signup-btn {
      background: white;
      color: black;
      width:70px;
      padding: 12px 30px;
      border-radius: 25px;
      text-align: center;
      font-size: 16px;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
      margin-top: 20px;
     
    }

    .signup-btn:hover {
      background: #ddd;
    }

    .login-btn {
      text-align: center;
      background: transparent;
      color: white;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 16px;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
      margin-top: 20px;
      border: 2px solid white;
     
      width:70px;
    }

    .login-btn:hover {
      background: rgba(255, 255, 255, 0.1);
    }
    
    
    /* Footer Social Links */
    .footer {
      padding: 15px 30px;
      display: flex;
      align-items: center;
      gap: 15px;
      background: rgba(33, 32, 32, 0.6);
      width: fit-content;
      margin: 40px 0px;
      border-radius: 25px;
    }

    .footer span {
      font-size: 14px;
      margin-right: 10px;
    }

    .footer a {
      color: white;
      font-size: 18px;
      text-decoration: none;
    }

    .footer a:hover {
      color: #bbb;
    }

    /* ---------------- UPCOMING EVENTS ---------------- */
    section.events {
      padding: 60px 100px;
      background: linear-gradient(to bottom, #f1f1f1, #d6d6d6);
      color: black;
    }

    .events h2 {
      font-size: 28px;
      margin-bottom: 30px;
    }

    .event-container {
      position: relative;
      display: flex;
      align-items: center;
    }

    .event-slider {
      display: flex;
      gap: 20px;
      overflow-x: auto;
      scroll-behavior: smooth;
      padding-bottom: 10px;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none; /* Firefox */
    }
    .event-slider::-webkit-scrollbar { display: none; } /* Chrome/Safari */

    .event-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
      min-width: 280px;
      max-width: 280px;
      overflow: hidden;
      flex-shrink: 0;
    }

    .event-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .event-info {
      padding: 15px;
    }

    .event-info h3 {
      margin: 0 0 10px;
      font-size: 18px;
      font-weight: bold;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .event-info p {
      font-size: 14px;
      color: #444;
      margin: 5px 0;
    }

    .event-info .description {
      margin-top: 10px;
      font-size: 13px;
      color: #666;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .event-info i {
      margin-right: 5px;
      color: black;
    }

    .events { position: relative; }

    .nav-btn {
      position: absolute;
      top: -75px; /* moved higher */
      transform: translateY(0);
      background: rgba(0,0,0,0.85);
      color: white;
      border: none;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      cursor: pointer;
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 6px 18px rgba(0,0,0,0.18);
      z-index: 20;
    }

    .nav-btn:disabled {
      cursor: default;
      opacity: 0.35;
    }

    /* place both buttons on the top-right near the heading; prev sits left of next */
    .prev { right: 86px; background: white; color: black; }
    .next { right: 28px; background: rgba(0,0,0,0.85); color: white; }

     /* About Section */
    .about {
      background-image: url('<?= asset('images/bg.jpeg') ?>');
      background-size: cover;
      background-position: center;
      text-align: center;
      padding: 100px 50px;
      color: white;
      position: relative;
    }
    .about::before {
      content: "";
      position: absolute; inset: 0;
      background: rgba(0,0,0,0.5);
    }
    .about h2 {
      position: relative;
      font-size: 30px;
      margin-bottom: 20px;
    }
    .about p {
      position: relative;
      max-width: 1100px;
      margin: 0 auto;
      font-size: 18px;
      line-height: 1.6;
      text-align: center
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
    /* Page load animations (slower for calmer feel) */
    .hero, .logo img, .nav-links, .signup-btn, .login-btn {
      opacity: 0;
      transform: translateY(18px) scale(0.98);
      /* increased duration for a smoother entrance */
      transition: opacity 1200ms cubic-bezier(.2,.9,.2,1), transform 1200ms cubic-bezier(.2,.9,.2,1);
    }

    body.page-loaded .logo img { opacity: 1; transform: translateY(0) scale(1); transition-delay: 260ms; }
    body.page-loaded .nav-links { opacity: 1; transform: translateY(0) scale(1); transition-delay: 360ms; }
    body.page-loaded .hero { opacity: 1; transform: translateY(0) scale(1); transition-delay: 480ms; }
    body.page-loaded .signup-btn { opacity: 1; transform: translateY(0) scale(1); transition-delay: 600ms; }
    body.page-loaded .login-btn { opacity: 1; transform: translateY(0) scale(1); transition-delay: 600ms; }

    /* Slight parallax-like background reveal via pseudo element */
    body::after {
      content: '';
      position: fixed; inset: 0; z-index: -1;
      background: linear-gradient(180deg, rgba(0,0,0,0.18), rgba(0,0,0,0.22));
      opacity: 0.0;
      /* slow background reveal to match hero timing */
      transition: opacity 1500ms ease;
    }
    body.page-loaded::after { opacity: 1; }
    
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
      <div class="loading-text">Loading Music...</div>
    </div>
  </div>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <a href="/" class="nav-link">
        <img src="{{ asset('images/Group-237.png') }}" alt="Sabra Music Logo">
      </a>
    </div>
    <div class="nav-links">
      <a href="/schedule" class="nav-link">SCHEDULE</a>
      <a href="#event">UP COMING</a>
      <a href="/history" class="nav-link">HISTORY</a>
      <a href="#about">ABOUT</a>
    </div>
    <div class="auth-section">
      <a href="/adminlogin" class="admin-btn">ADMIN</a>
    </div>
  </nav>

  <script>
    // Hide loading overlay when page loads
    document.addEventListener('DOMContentLoaded', function() {
      const loadingOverlay = document.getElementById('loadingOverlay');
      
      // Hide loading overlay after a brief delay for visual effect
      setTimeout(() => {
        loadingOverlay.classList.add('hidden');
        document.body.classList.add('page-loaded');
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

  <!-- Hero Section -->
  <section class="hero">
    <small>ELEVATE YOUR MUSICAL JOURNEY</small>
  <h1 class="headline-lines">FEEL THE RYTHEM<br>OF YOUR SOUL !</h1>
   <div class="floating-notes" aria-hidden="true">
      <span class="note n1">♪</span>
      <span class="note n2">♫</span>
      <span class="note n3">♬</span>
    </div>
    <div class="hero-sub">
      <h3 class="title-hero">Art Center Digital Platform - SUSL</h3><br>
      A smart and user-friendly platform to manage the activities of the Art Center, including event scheduling, resource allocation, registrations, and performance records. This system enhances efficiency, supports creativity, and helps streamline cultural and artistic programs within the university.</div>
    <!-- Call to Action Buttons -->
     <div class="button-row">    
      <a href="/signup" class="signup-btn nav-link" >Sign Up</a>
      <a href="/login" class="login-btn nav-link" >Login</a>
  </div>
   
      <!-- Footer Social Icons -->
  <div class="footer">
    <span>Follow</span>
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-facebook"></i></a>
    <a href="#"><i class="fab fa-linkedin"></i></a>
  </div>
  </section>



  <section class="events" id="event">
    <h2>Up Coming Event</h2>
    <div class="event-container">
      <button class="nav-btn prev" onclick="scrollSlider(-1)">&#10094;</button>

      <div class="event-slider" id="eventSlider">
        @forelse($upcoming_events as $event)
          <div class="event-card">
            @if($event->image)
              <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}">
            @else
              <img src="{{ asset('images/bg1.jpg') }}" alt="{{ $event->title }}">
            @endif
            <div class="event-info">
              <h3>{{ $event->title }}</h3>
              <p><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</p>
              <p><i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</p>
              <p><i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($event->event_time)->format('h:i A') }}</p>
              <p class="description">{{ \Illuminate\Support\Str::limit($event->description, 80) }}</p>
            </div>
          </div>
        @empty
          <div class="event-card">
            <img src="{{ asset('images/bg.jpeg') }}" alt="No Events">
            <div class="event-info">
              <h3>No Upcoming Events</h3>
              <p>Check back soon for new events</p>
            </div>
          </div>
        @endforelse
      </div>

      <button class="nav-btn next" onclick="scrollSlider(1)">&#10095;</button>
    </div>
  </section>

  <script>
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

    function scrollSlider(dir) {
      const slider = document.getElementById('eventSlider');
      if (!slider) return;
      const card = slider.querySelector('.event-card');
      const style = window.getComputedStyle(slider);
      // gap parsing (fallback to 20)
      const gap = parseInt(style.getPropertyValue('gap')) || 20;
      const scrollAmount = (card ? card.offsetWidth : 300) + gap;
      slider.scrollBy({ left: dir * scrollAmount, behavior: 'smooth' });
    }

    // update prev/next disabled state
    document.addEventListener('DOMContentLoaded', function () {
      const slider = document.getElementById('eventSlider');
      const prev = document.querySelector('.prev');
      const next = document.querySelector('.next');

      if (!slider || !prev || !next) return;

      function updateButtons() {
        prev.disabled = slider.scrollLeft <= 0;
        next.disabled = slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 1;
        prev.style.opacity = prev.disabled ? '0.4' : '1';
        next.style.opacity = next.disabled ? '0.4' : '1';
      }

      slider.addEventListener('scroll', updateButtons);
      window.addEventListener('resize', updateButtons);
      updateButtons();
    });
  </script>

  <!-- About -->
  <section class="about" id="about">
    <h2>About Us</h2>
    <p>
    Welcome to Sabra Music - the digital heart of SUSL's Art Center. We're dedicated to nurturing artistic talent and 
    cultural expression within our university community. Our platform streamlines music resource management, 
    practice scheduling, and performance organization, empowering students and faculty to focus on what matters most - 
    creating beautiful music. Through technology and passion, we're building a vibrant musical ecosystem that 
    celebrates creativity and cultural heritage at the University.
    </p>

  </section>

  <!-- Footer -->
  <footer class="main-footer">
    © 2025 | Sabra Music | All Rights Reserved
  </footer>

</body>
</html>
