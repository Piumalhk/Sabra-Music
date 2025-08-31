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
      background-image: url('<?= asset('images/bg 2.png') ?>');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      flex-direction: column;
      color: white;
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
      <a href="/home" class="nav-link">
      <img src="<?= asset('images/Group-237.png') ?>" alt="Sabra Music Logo">
    </div>

    <div class="nav-links">
      <a href="#">SCHEDULE</a>
      <a href="#">UP COMING</a>
      <a href="/history" class="nav-link">HISTORY</a>
      <a href="#">ABOUT</a>
    </div>

    <a href="admin.php" class="admin-btn">ADMIN</a>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div>
      <h1>
        Easily Reserve Spaces For Your Events, Exhibitions, And Performances. 
        Choose Your Preferred Date, Time, And Venue — 
        And Secure Your Spot At The Art Center In Just A Few Clicks.
      </h1>
      <a href="/booking" class="start-btn nav-link">START BOOKING</a>
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
</script>
</body>
</html>
