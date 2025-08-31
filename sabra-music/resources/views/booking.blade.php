<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabra Music - Booking</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #0d1b2a;
      background-image:  url('<?= asset('images/bg 2.png') ?>');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      min-height: 100vh;
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


    /* Booking Form */
    .form-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 50px 20px;
    }

    .booking-form {
      background: rgba(178, 178, 178, 0.7);
      padding: 40px;
      border-radius: 20px;
      width: 900px;
      max-width: 100%;
      box-shadow: 0 8px 25px rgba(0,0,0,0.6);
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    label {
      display: block;
      font-size: 14px;
      margin-bottom: 20px;
      color: black;
    }

    input, select, textarea {
      width: 90%;
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid black;
      background: rgba(255,255,255,0.1);
      color: white;
      font-size: 14px;
      outline: none;
    }

    input:focus, select:focus, textarea:focus {
      border-color: black;
      background: rgba(255,255,255,0.15);
    }

    textarea {
      resize: none;
      grid-column: span 2;
      height: 100px;
      width: 95%;
    
    }
    input::placeholder,
    textarea::placeholder {
    color: #423b3bff; /* Change this to your desired color */
    opacity: 1;
    }  

    .submit-btn {
      margin-top: 20px;
      background: white;
      color: #0d1b2a;
      border: none;
      padding: 12px 30px;
      border-radius: 25px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .submit-btn:hover {
      background: #ddd;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar">
    <div class="logo">
      <a href="/home">
      <img src="{{ asset('images/Group-237.png') }}" alt="Sabra Music Logo">
    </div>

    <div class="nav-links">
      <a href="#">SCHEDULE</a>
      <a href="#">UP COMING</a>
      <a href="#">HISTORY</a>
      <a href="#">ABOUT</a>
    </div>

    <a href="admin.php" class="admin-btn">ADMIN</a>
  </nav>

  <!-- Booking Form Section -->
  <div class="form-container">
    <form class="booking-form">
      <div class="form-grid">
        <div>
          <label>Event Name</label>
          <input type="text" placeholder="Name">
        </div>
        <div>
          <label>Faculty</label>
          <input type="text" placeholder="Faculty">
        </div>

        <div>
          <label>Event ID</label>
          <input type="text" placeholder="Event ID">
        </div>
        <div>
          <label>Event Location</label>
          <input type="text" placeholder="Location">
        </div>

        <div>
          <label>Email</label>
          <input type="email" placeholder="Email">
        </div>
        <div>
          <label>Address</label>
          <input type="text" placeholder="Address 1">
        </div>

        <div>
          <label>Date</label>
          <input type="date" placeholder="Select date" style="color:#423b3bff; opacity:1">
        </div>
        <div>
    
          <input type="text" placeholder="Address 2">
        </div>

         <div>
          <label>Time Slot</label>
          <input type="time" placeholder="Select time" style="color:#423b3bff; opacity:1">
        </div>
        <div>
          <label>Fees</label>
          <input type="text" placeholder="Your fees">
        </div>
      </div>

      <div>
        <label style="margin-top: 20px;">Description</label>
        <textarea placeholder="Type Here"></textarea>
      </div>

      <button type="submit" class="submit-btn">Submit Booking</button>
    </form>
  </div>

</body>
</html>
