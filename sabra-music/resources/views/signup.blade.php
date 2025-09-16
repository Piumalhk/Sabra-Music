<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sabra Music - Sign Up</title>
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

    /* Signup Form */
    .signup-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .signup-box {
      background: rgba(178, 178, 178, 0.7);
      color: #222;          
      padding: 40px;
      border-radius: 10px;
      width: 350px;
      text-align: center;
      position: relative;
      left: -450px;   
    }

    .signup-box h2 {
      margin-bottom: 25px;
      font-size: 22px;
      font-weight: bold;
      color: #fff;
    }

    .signup-box input {
      width: 100%;
      padding: 12px 16px;
      margin: 10px 0;
      border: none;
      border-radius: 4px;
      background: #333;
      color: white;
      font-size: 14px;
      box-sizing: border-box;
    }

    .signup-box input::placeholder {
      color: #bbb;
    }

    .signup-box button {
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

    .signup-box button:hover {
      background: #ccc;
    }

    /* Error and Success Messages */
    .error-messages, .error-message {
      margin: 15px 0;
    }

    .error {
      color: #ff6b6b;
      font-size: 12px;
      margin: 5px 0;
      text-align: center;
    }

    .signup-box p {
      margin-top: 15px;
      font-size: 13px;
      color: #bbb;
    }

    .signup-box p a {
      color: white;
      text-decoration: underline;
    }

    /* Auto-typing text popup */
    .typing-popup {
      position: fixed;
      right: 150px;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 30px;
      border-radius: 30px;
     text-align: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
      width: 700px;
      height: 435px;
      margin-top: 50px;
      backdrop-filter: blur(5px);
    
    
    }

    .typing-popup h3 {
      margin: 30px 0 15px 0;
      font-size: 45px;
      color: #fff;
    }
    .typing-text {
      font-size: 30px;
      line-height: 1.5;
      min-height: 60px;
     margin-top: 20px;
  
    }

    .cursor {
      animation: blink 1s infinite;
    }

    @keyframes blink {
      0%, 50% { opacity: 1; }
      51%, 100% { opacity: 0; }}

         /* Footer Social Links */
    .footer {
      padding: 15px 30px;
      display: flex;
      align-items: center;
      gap: 15px;
       background: rgba(33, 32, 32, 0.6);
      width: fit-content;
      margin: 250px 420px;
      border-radius: 25px;
      backdrop-filter: blur(5px);
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
      <a href="{{ url('/') }}">
        <img src="{{ asset('images/Group-237.png') }}" alt="Sabra Music Logo">
      </a>
    </div>

    <a href="{{ url('/adminlogin') }}" class="admin-btn">ADMIN</a>
  </nav>

  <!-- Signup Section -->
  <div class="signup-container">
    <div class="signup-box">
      <h2>SIGN UP</h2>
      
      @if ($errors->any())
        <div class="error-messages">
          @foreach ($errors->all() as $error)
            <p class="error">{{ $error }}</p>
          @endforeach
        </div>
      @endif

      @if (session('error'))
        <div class="error-message">
          <p class="error">{{ session('error') }}</p>
        </div>
      @endif
      
      <form action="{{ url('/signup') }}" method="POST">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" placeholder="EMAIL :" required>
        <input type="text" name="index_no" value="{{ old('index_no') }}" placeholder="INDEX NO :" required>
        <input type="password" name="password" placeholder="ENTER PASSWORD :" required>
        <input type="password" name="password_confirmation" placeholder="CONFIRM PASSWORD :" required>
        <button type="submit">SIGN UP</button>
      </form>
      <p>Already Have An Account? <a href="{{ url('/login') }}">Login</a></p>
    </div>
  </div>

   <!-- Auto-typing popup -->
  <div class="typing-popup">
    <h3>Welcome to Sabra Music!</h3>
    <div class="typing-text" id="typingText"></div>
    <div class="footer">
    <span>Follow</span>
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-facebook"></i></a>
    <a href="#"><i class="fab fa-linkedin"></i></a>
  </div>
  </div>

  <script>
    const texts = [
      "Join our musical community today!",
      "Discover amazing events and performances.",
      "Book venues for your musical journey.",
      "Connect with fellow music enthusiasts.",
      "Experience the rhythm of your soul!"
    ];

    let textIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    const typingElement = document.getElementById('typingText');
    const typingSpeed = 100;
    const deletingSpeed = 50;
    const pauseTime = 2000;

    function typeText() {
      const currentText = texts[textIndex];
      
      if (!isDeleting) {
        // Typing
        typingElement.innerHTML = currentText.substring(0, charIndex + 1) + '<span class="cursor">|</span>';
        charIndex++;
        
        if (charIndex === currentText.length) {
          isDeleting = true;
          setTimeout(typeText, pauseTime);
          return;
        }
        setTimeout(typeText, typingSpeed);
      } else {
        // Deleting
        typingElement.innerHTML = currentText.substring(0, charIndex) + '<span class="cursor">|</span>';
        charIndex--;
        
        if (charIndex === 0) {
          isDeleting = false;
          textIndex = (textIndex + 1) % texts.length;
          setTimeout(typeText, 500);
          return;
        }
        setTimeout(typeText, deletingSpeed);
      }
    }

    // Start typing animation when page loads
    document.addEventListener('DOMContentLoaded', function() {
      setTimeout(typeText, 1000);
    });
  </script>

</body>
</html>
