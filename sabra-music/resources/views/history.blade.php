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
      background-image: url('<?= asset('images/bg1.jpg') ?>');
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
      <a href="/home">
      <img src="<?= asset('images/Group-237.png') ?>" alt="Sabra Music Logo">
    </div>
    <div class="nav-links">
      <a href="#">SCHEDULE</a>
      <a href="#">UP COMING</a>
      <a href="#">HISTORY</a>
      <a href="#">ABOUT</a>
    </div>
    <a href="admin.php" class="admin-btn">ADMIN</a>
  </nav>

  <section class="history-section">
    <div class="history-title">PAST EVENTS</div>
    <div class="event-list">
      <div class="event-row">
        <div class="event-date">Nov 18</div>
        <div class="event-card">
          <div class="event-details">
            <div class="event-live"><span class="event-live-dot"></span>LIVE</div>
            <div class="event-title">Nethrawani</div>
            <div class="event-location"><i class="fas fa-map-marker-alt"></i>Panibharatha Open Air Theatre</div>
            <div class="event-faculty"><i class="fas fa-home"></i>Faculty Of Management Studies</div>
          </div>
          <img class="event-img" src="<?= asset('images/history1.jpg') ?>" alt="Nethrawani">
        </div>
      </div>
      <div class="event-row">
        <div class="event-date">Dec 20</div>
        <div class="event-card">
          <div class="event-details">
            <div class="event-title">Adawwa</div>
            <div class="event-location"><i class="fas fa-map-marker-alt"></i>Matta Canteen</div>
            <div class="event-faculty"><i class="fas fa-home"></i>Faculty Of Computing</div>
          </div>
          <img class="event-img" src="<?= asset('images/history2.jpg') ?>" alt="Adawwa">
        </div>
      </div>
    </div>
  </section>

  <footer class="main-footer">
    © 2025 | Sabra Music | All Rights Reserved
  </footer>
</body>
</html>
