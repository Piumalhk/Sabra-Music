<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Check Booking • Sabra Music</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
  :root{--bg:#071022;--panel:#0b1220;--muted:#9ca3af;--accent:#10b981}
  body{margin:0;font-family:Inter,Arial,Helvetica,sans-serif;color:#e6eef6;background:linear-gradient(rgba(0,0,0,0.55),rgba(0,0,0,0.55)), url('{{ asset("images/bg1.jpg") }}') center/cover no-repeat;}

  /* center content */
  .wrap{max-width:980px;margin:0 auto;padding:28px;min-height:80vh;display:flex;align-items:center;justify-content:center}

  /* translucent panel with blur */
  .panel{background:rgba(3,6,9,0.55);backdrop-filter:blur(6px);border-radius:14px;padding:28px;border:1px solid rgba(255,255,255,0.04);box-shadow:0 10px 40px rgba(2,6,23,0.6);width:920px}
  h1{margin:0 0 12px;font-size:22px;text-align:center}
    label{display:block;color:var(--muted);font-size:13px;margin-bottom:6px}
    select,input{width:100%;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:#e6eef6}
    .form-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px}
    .controls{display:flex;gap:8px;align-items:center;margin-top:12px}
    .btn{padding:10px 14px;border-radius:8px;border:0;cursor:pointer}
    .btn.primary{background:var(--accent);color:#07221a}
    .result{margin-top:12px;padding:12px;border-radius:8px;background:rgba(255,255,255,0.012);display:flex;justify-content:space-between;align-items:center}
    .badge{padding:6px 10px;border-radius:20px;font-weight:600}
    .badge.ok{background:rgba(16,185,129,0.12);color:var(--accent)}
    .badge.busy{background:rgba(239,68,68,0.08);color:#ef4444}
    table{width:100%;border-collapse:collapse;margin-top:12px}
    th,td{padding:10px;text-align:left;border-bottom:1px solid rgba(255,255,255,0.03);font-size:14px}
    th{color:var(--muted);font-weight:600}
    .tabs{display:flex;gap:8px;margin-top:12px}
    .tabs button{padding:8px 10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:var(--muted);cursor:pointer}
    .tabs button.active{background:rgba(255,255,255,0.03);color:#fff}
  </style>
</head>
<body>

  <div class="wrap">
    <div class="panel">
      <h1>Check Booking Availability</h1>
      <p style="color:var(--muted);margin:6px 0 12px">Pick a center, date and time to see if the slot is available and the current status of bookings.</p>

      <div class="form-grid">
        <div>
          <label>Center</label>
          <select id="centerSelect">
            <option value="Center A">Center A</option>
            <option value="Center B">Center B</option>
            <option value="Center C">Center C</option>
          </select>
        </div>

        <div>
          <label>Date</label>
          <input id="dateInput" type="date">
        </div>

        <div>
          <label>Time</label>
          <input id="timeInput" type="time">
        </div>
      </div>

      <div class="controls">
        <button id="checkBtn" class="btn primary">Check Availability</button>
        <div style="color:var(--muted);font-size:13px">Tip: this checks a simulated schedule on the client side.</div>
      </div>

      <div id="result" class="result" style="display:none">
        <div>
          <div id="resultText" style="font-weight:700">Available</div>
          <div id="resultSub" style="color:var(--muted);font-size:13px">No conflicting bookings found.</div>
        </div>
        <div id="resultBadge" class="badge ok">Available</div>
      </div>

      <div style="height:8px"></div>

      <div style="display:flex;justify-content:space-between;align-items:center">
        <h3 style="margin:0">Recent Bookings</h3>
        <div class="tabs" id="statusTabs">
          <button data-filter="all" class="active">All</button>
          <button data-filter="pending">Pending</button>
          <button data-filter="approved">Approved</button>
          <button data-filter="rejected">Rejected</button>
        </div>
      </div>

      <div style="margin-top:8px;overflow:auto">
        <table id="bookingsTable">
          <thead><tr><th>Center</th><th>Date</th><th>Time</th><th>User</th><th>Status</th></tr></thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    // Simulated booking data (replace with server data later)
    const bookings = [
      {center:'Center A', date:'2025-09-05', time:'10:00', user:'alice@example.com', status:'approved'},
      {center:'Center A', date:'2025-09-05', time:'14:00', user:'bob@example.com', status:'pending'},
      {center:'Center B', date:'2025-09-06', time:'09:00', user:'carol@example.com', status:'approved'},
      {center:'Center C', date:'2025-09-05', time:'10:00', user:'dave@example.com', status:'rejected'},
    ];

    function renderBookings(filter='all'){
      const tbody = document.querySelector('#bookingsTable tbody');
      tbody.innerHTML='';
      bookings.filter(b => filter==='all' || b.status===filter).forEach(b => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${b.center}</td><td>${b.date}</td><td>${b.time}</td><td>${b.user}</td><td style="text-transform:capitalize">${b.status}</td>`;
        tbody.appendChild(tr);
      });
    }

    function isConflict(center, date, time){
      return bookings.some(b => b.center===center && b.date===date && b.time===time && b.status!=='rejected');
    }

    document.getElementById('checkBtn').addEventListener('click', ()=>{
      const center = document.getElementById('centerSelect').value;
      const date = document.getElementById('dateInput').value;
      const time = document.getElementById('timeInput').value;
      if(!date || !time){ alert('Please select a date and time'); return; }
      const conflict = isConflict(center,date,time);
      const result = document.getElementById('result');
      const text = document.getElementById('resultText');
      const sub = document.getElementById('resultSub');
      const badge = document.getElementById('resultBadge');
      if(conflict){
        text.innerText='Not available';
        sub.innerText='There is an existing booking or pending request for this slot.';
        badge.className='badge busy'; badge.innerText='Booked';
      } else {
        text.innerText='Available';
        sub.innerText='No conflicting bookings found.';
        badge.className='badge ok'; badge.innerText='Available';
      }
      result.style.display='flex';
    });

    document.querySelectorAll('#statusTabs button').forEach(btn=>btn.addEventListener('click', ()=>{
      document.querySelectorAll('#statusTabs button').forEach(b=>b.classList.remove('active'));
      btn.classList.add('active');
      renderBookings(btn.getAttribute('data-filter'));
    }));

    renderBookings();
  </script>
</body>
</html>
