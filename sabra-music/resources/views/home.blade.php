<?php
// navbar.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabra Music</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #111; /* Dark background */
      background-image: url('<?= asset('images/bg1.jpg') ?>');
      background-size: cover;     /* make it cover the screen */
      background-position: right; /* center image */
      background-repeat: no-repeat;
      height: 120vh;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background:none;
      padding: 25px 100px;
      height: 60px;
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      height: 50px; /* Adjust to your logo */

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
  </style>
</head>
<body>
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
</body>
</html>
