<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Booking Success • Sabra Music</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root{--bg:#071022;--panel:#0b1220;--muted:#9ca3af;--accent:#10b981}
    body{
        margin:0;
        font-family:Inter,Arial,Helvetica,sans-serif;
        color:#e6eef6;
        background:linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.55)), url('{{ asset("images/bg1.jpg") }}') center/cover no-repeat;
        min-height:100vh;
        display:flex;
        flex-direction:column;
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
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
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
        color: var(--accent);
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
        background: var(--accent);
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
  </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <a href="/home">
                <img src="{{ asset('images/Group-237.png') }}" alt="Sabra Music Logo">
            </a>
        </div>

        <div class="nav-links">
            <a href="/schedule">SCHEDULE</a>
            <a href="#">UP COMING</a>
            <a href="/history">HISTORY</a>
            <a href="#">ABOUT</a>
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
</body>
</html>
