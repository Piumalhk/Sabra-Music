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

    /* PDF upload area */
    .pdf-upload {
      margin-top: 18px;
      padding: 14px;
      border-radius: 12px;
      background: rgba(13,27,42,0.12);
      border: 1px dashed rgba(255,255,255,0.06);
      display: flex;
      align-items: center;
      gap: 14px;
      color: #e6eef6;
    }

    .pdf-dropzone{
      flex:1;
      min-height:80px;
      display:flex;
      align-items:center;
      justify-content:center;
      gap:12px;
      text-align:center;
      padding:12px;
      border-radius:10px;
      background:linear-gradient(180deg, rgba(255,255,255,0.01), transparent);
      cursor:pointer;
      transition:background .18s, border-color .18s;
    }

    .pdf-dropzone.dragover{background:rgba(16,185,129,0.06);border-color:rgba(16,185,129,0.3)}

    .pdf-info{display:flex;flex-direction:column;gap:6px;min-width:220px}
    .pdf-info .name{font-weight:600}
    .pdf-info .meta{font-size:13px;color:#cbd5e1}
    .file-remove{background:transparent;border:1px solid rgba(255,255,255,0.06);padding:6px 10px;border-radius:8px;color:#e6eef6;cursor:pointer}

    .hidden-file{display:none}
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
      <a href="/history">HISTORY</a>
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

      <!-- PDF upload area -->
      <div class="pdf-upload">
        <div id="dropzone" class="pdf-dropzone">
          <div style="display:flex;flex-direction:column;align-items:center">
            <i class="fas fa-file-pdf" style="font-size:28px;color:#ef4444"></i>
            <div style="margin-top:6px">Drag & drop a PDF here or <span style="text-decoration:underline">browse</span></div>
            <div style="font-size:12px;color:#cbd5e1;margin-top:6px">Max 10MB · PDF only</div>
          </div>
          <input id="pdfInput" class="hidden-file" type="file" accept="application/pdf">
        </div>

        <div class="pdf-info" id="pdfInfo">
          <div class="name">No file selected</div>
          <div class="meta">Upload a PDF with supporting documents (rider, schedule, proposal)</div>
          <div style="display:flex;gap:8px;margin-top:8px">
            <button id="removeFile" class="file-remove" type="button" style="display:none">Remove</button>
            <button id="changeFile" class="file-remove" type="button" style="display:none">Change</button>
          </div>
        </div>
      </div>

      <button type="submit" class="submit-btn">Submit Booking</button>
    </form>
  </div>

</body>
</html>

  <script>
    (function(){
      const dropzone = document.getElementById('dropzone');
      const pdfInput = document.getElementById('pdfInput');
      const pdfInfo = document.getElementById('pdfInfo');
      const removeBtn = document.getElementById('removeFile');
      const changeBtn = document.getElementById('changeFile');

      function showFile(file){
        pdfInfo.querySelector('.name').innerText = file.name;
        pdfInfo.querySelector('.meta').innerText = Math.round(file.size/1024) + ' KB · ' + file.type;
        removeBtn.style.display = 'inline-block';
        changeBtn.style.display = 'inline-block';
      }

      function clearFile(){
        pdfInput.value = '';
        pdfInfo.querySelector('.name').innerText = 'No file selected';
        pdfInfo.querySelector('.meta').innerText = 'Upload a PDF with supporting documents (rider, schedule, proposal)';
        removeBtn.style.display = 'none';
        changeBtn.style.display = 'none';
      }

      dropzone.addEventListener('click', ()=> pdfInput.click());

      dropzone.addEventListener('dragover', (e)=>{ e.preventDefault(); dropzone.classList.add('dragover'); });
      dropzone.addEventListener('dragleave', (e)=>{ e.preventDefault(); dropzone.classList.remove('dragover'); });
      dropzone.addEventListener('drop', (e)=>{
        e.preventDefault(); dropzone.classList.remove('dragover');
        const file = e.dataTransfer.files && e.dataTransfer.files[0];
        handleFile(file);
      });

      pdfInput.addEventListener('change', (e)=>{
        const file = e.target.files && e.target.files[0];
        handleFile(file);
      });

      removeBtn.addEventListener('click', clearFile);
      changeBtn.addEventListener('click', ()=> pdfInput.click());

      function handleFile(file){
        if (!file) return;
        if (file.type !== 'application/pdf') { alert('Please upload a PDF file.'); return; }
        if (file.size > 10 * 1024 * 1024) { alert('File too large. Max is 10MB.'); return; }
        showFile(file);
      }
    })();
  </script>
