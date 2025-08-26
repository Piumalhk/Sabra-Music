<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabra Music - Sign IN</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #111; 
      background-image: url('<?= asset('images/bg1.jpg') ?>');
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

    /* Signin Form */
    .signin-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .signin-box {
      background: rgba(178, 178, 178, 0.7);
      color: #222;          
      padding: 40px;
      border-radius: 10px;
      width: 350px;
      text-align: center;
      position: relative;
      left: -320px;   
    }

    .signin-box h2 {
      margin-bottom: 25px;
      font-size: 22px;
      font-weight: bold;
      color: #fff;
    }

    .signin-box input {
      width: 100%;
      padding: 12px 16px;
      margin: 30px 0;
      border: none;
      border-radius: 4px;
      background: #333;
      color: white;
      font-size: 14px;
      box-sizing: border-box;
    }

    .signin-box input::placeholder {
      color: #bbb;
    }

    .signin-box button {
      width: 100%;
      padding: 12px;
      background: white;
      color: black;
      border: none;
      border-radius: 4px;
      font-weight: bold;
      font-size: 14px;
      margin-top: 15px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .signin-box button:hover {
      background: #ddd;
    }

    .signin-box p {
      margin-top: 15px;
      font-size: 13px;
      color: #bbb;
    }

    .signin-box p a {
      color: white;
      text-decoration: underline;
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

  <!-- Signin Section -->
  <div class="signin-container">
    <div class="signin-box">
      <h2>SIGN IN</h2>
      <form action="#" method="POST">
      
        <input type="text" name="index_no" placeholder="INDEX NO :" required>
        <input type="password" name="password" placeholder="ENTER PASSWORD :" required>

        <button type="submit" style="margin-top: 40px;margin-bottom: 40px;">SIGN IN</button>
      </form>
      
    </div>
  </div>

</body>
</html>
