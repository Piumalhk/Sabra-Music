<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Booking Success • Sabra Music</title>
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
      --muted: #9ca3af;
      --panel: #0b1220;
    }

    body {
      margin: 0;
      font-family: 'Montserrat', Arial, sans-serif;
      color: #e6eef6;
      background: linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.55)), url('{{ asset("images/bg1.jpg") }}') center/cover no-repeat;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Navbar */
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

    /* center content */
    .wrap{
        max-width:700px;
        margin:0 auto;
        padding:28px;
        flex-grow:1;
        display:flex;
        align-items:center;
        justify-content:center;
    }

    /* translucent panel with blur */
    .panel{
        background:rgba(3,6,9,0.55);
        backdrop-filter:blur(6px);
        border-radius:14px;
        padding:40px;
        border:1px solid rgba(255,255,255,0.04);
        box-shadow:0 10px 40px rgba(2,6,23,0.6);
        width:100%;
        text-align:center;
    }

    h1{
        margin:0 0 20px;
        font-size:28px;
    }

    .success-icon {
        font-size: 60px;
        color: #10b981; /* Green color */
        margin-bottom: 20px;
    }

    .btn{
        display: inline-block;
        padding: 12px 24px;
        border-radius: 30px;
        border: 0;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        margin-top: 20px;
        transition: transform 0.2s;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn.primary{
        background: #10b981; /* Green color */
        color: #fff;
    }

    .btn.secondary {
        background: rgba(255,255,255,0.1);
        color: #fff;
        margin-left: 10px;
    }

    .details {
        margin: 20px 0;
        padding: 15px;
        background: rgba(255,255,255,0.05);
        border-radius: 10px;
        text-align: left;
    }

    .details p {
        margin: 5px 0;
        color: var(--muted);
    }

    .details strong {
        color: #fff;
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
      background: linear-gradient(to top, var(--accent), var(--primary));
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
      <div class="loading-text">Loading...</div>
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
      <a href="#" class="nav-link">UP COMING</a>
      <a href="{{ route('booking.history') }}" class="nav-link">HISTORY</a>
      <a href="#" class="nav-link">ABOUT</a>
    </div>
    
    <div class="auth-section">
      <a href="{{ route('admin.login') }}" class="admin-btn nav-link">ADMIN</a>
    </div>
  </nav>

    <div class="wrap">
        <div class="panel">
            <i class="fas fa-check-circle success-icon"></i>
            <h1>Booking Submitted Successfully!</h1>
            <p>Your booking request has been received and is pending approval. You will be notified once it's approved.</p>
            
            @if(session('success'))
                <div class="details">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            
            <div>
                <a href="/check" class="btn primary">View My Bookings</a>
                <a href="/booking" class="btn secondary">New Booking</a>
            </div>
        </div>
    </div>

    <script>
      // Hide loading overlay after page loads
      window.addEventListener('load', function() {
        setTimeout(function() {
          document.getElementById('loadingOverlay').classList.add('hidden');
        }, 500);
      });
    </script>
</body>
</html>
