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
      padding: 80px 100px;
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
      background: rgba(0, 0, 0, 0.6);
      width: fit-content;
      margin: 40px 100px;
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
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
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

  <!-- Hero Section -->
  <section class="hero">
    <small>ELEVATE YOUR MUSICAL JOURNEY</small>
    <h1>Feel The <br> Rhythm Of Your Soul!</h1>
    <a href="#" class="signup-btn">Sign Up</a>
  </section>

  <!-- Footer Social Icons -->
  <div class="footer">
    <span>Follow</span>
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-facebook"></i></a>
    <a href="#"><i class="fab fa-linkedin"></i></a>
  </div>

</body>
</html>
