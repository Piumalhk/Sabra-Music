<?php


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
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #111; 
      background-image: url('<?= asset('images/bg1.jpg') ?>');
      background-size: cover;
      background-position: right;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      color: white;
      scroll-behavior: smooth;
    }

    /* Navbar */
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

    /* Hero Section */
    .hero {
      padding: 80px 110px;
      max-width: 600px;
    }

    .hero small {
      font-size: 12px;
      letter-spacing: 2px;
      text-transform: uppercase;
      color: #bbb;
    }

    .hero h1 {
      font-size: 50px;
      font-weight: bold;
      margin: 20px 0;
      line-height: 1.2;
    }

    .signup-btn {
      background: white;
      color: black;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 16px;
      text-decoration: none;
      font-weight: bold;
      display: inline-block;
      margin-top: 20px;
    }

    .signup-btn:hover {
      background: #ddd;
    }

    /* Footer Social Links */
    .footer {
      padding: 15px 30px;
      display: flex;
      align-items: center;
      gap: 15px;
      background: rgba(33, 32, 32, 0.6);
      width: fit-content;
      margin: 40px 90px;
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
    }

    .event-info p {
      font-size: 14px;
      color: #444;
      margin: 5px 0;
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
      max-width: 700px;
      margin: 0 auto;
      font-size: 18px;
      line-height: 1.6;
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

    /* Music Bars Animation */
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

    @keyframes pulse {
      0%, 100% { opacity: 0.7; }
      50% { opacity: 1; }
    }

    .loading-overlay.show {
      display: flex;
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
      <img src="<?= asset('images/Group-237.png') ?>" alt="Sabra Music Logo">
    </div>

    <div class="nav-links">
      <a href="/schedule" class="nav-link">SCHEDULE</a>
      <a href="#event"  >UP COMING</a>
      <a href="/history" class="nav-link">HISTORY</a>
      <a href="#about">ABOUT</a>
    </div>

    <a href="/adminlogin" class="admin-btn">ADMIN</a>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <small>ELEVATE YOUR MUSICAL JOURNEY</small>
    <h1>Feel The <br> Rhythm Of Your <br> Soul!</h1>
    <a href="/signup" class="signup-btn nav-link" >Sign Up</a>
  </section>

  <!-- Footer Social Icons -->
  <div class="footer">
    <span>Follow</span>
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-facebook"></i></a>
    <a href="#"><i class="fab fa-linkedin"></i></a>
  </div>

  <section class="events" id="event">
    <h2>Up Coming Event</h2>
    <div class="event-container">
      <button class="nav-btn prev" onclick="scrollSlider(-1)">&#10094;</button>

      <div class="event-slider" id="eventSlider">
        <div class="event-card">
          <img src="<?= asset('images/bg.jpeg') ?>" alt="Event 1">
          <div class="event-info">
            <h3>Ridmya – 2026</h3>
            <p><i class="fas fa-map-marker-alt"></i> Faculty of Management Studies</p>
          </div>
        </div>

        <div class="event-card">
          <img src="<?= asset('images/bg1.jpg') ?>" alt="Event 2">
          <div class="event-info">
            <h3>Raathriya Wee – 2026</h3>
            <p><i class="fas fa-map-marker-alt"></i> Faculty of Applied Science</p>
          </div>
        </div>

        <div class="event-card">
          <img src="<?= asset('images/bg 2.png') ?>" alt="Event 2">
          <div class="event-info">
            <h3>Raathriya Wee – 2026</h3>
            <p><i class="fas fa-map-marker-alt"></i> Faculty of Applied Science</p>
          </div>
        </div>

        <div class="event-card">
          <img src="<?= asset('images/bg.jpeg') ?>" alt="Event 2">
          <div class="event-info">
            <h3>Raathriya Wee – 2026</h3>
            <p><i class="fas fa-map-marker-alt"></i> Faculty of Applied Science</p>
          </div>
        </div>

        <div class="event-card">
          <img src="<?= asset('images/bg1.jpg') ?>" alt="Event 2">
          <div class="event-info">
            <h3>Raathriya Wee – 2026</h3>
            <p><i class="fas fa-map-marker-alt"></i> Faculty of Applied Science</p>
          </div>
        </div>

        <div class="event-card">
          <img src="<?= asset('images/bg.jpeg') ?>" alt="Event 2">
          <div class="event-info">
            <h3>Raathriya Wee – 2026</h3>
            <p><i class="fas fa-map-marker-alt"></i> Faculty of Applied Science</p>
          </div>
        </div>

        <div class="event-card">
          <img src="<?= asset('images/bg1.jpg') ?>" alt="Event 3">
          <div class="event-info">
            <h3>Raathriya Wee – 2026</h3>
            <p><i class="fas fa-map-marker-alt"></i> Faculty of Applied Science</p>
          </div>
        </div>
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
      Seamless Flight Booking And Travel Planning At Your Fingertips—Effortless, 
      Affordable, And Stress-Free Journeys Await You.
    </p>
  </section>

  <!-- Footer -->
  <footer class="main-footer">
    © 2025 | Sabra Music | All Rights Reserved
  </footer>

</body>
</html>
