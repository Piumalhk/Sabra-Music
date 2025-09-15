<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin • Sabra Music</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root{--bg:#0f1724;--panel:#0b1220;--muted:#9ca3af;--accent:#10b981;--card:#0b1226}
        *{box-sizing:border-box}
        body{margin:0;font-family:Inter,ui-sans-serif,system-ui,Segoe UI,Roboto,Arial;background:linear-gradient(180deg,#0b1220 0%, #071022 100%);color:#e6eef6}
        .app{display:flex;min-height:100vh}

        /* Sidebar */
        .sidebar{width:260px;padding:20px 22px;background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);border-right:1px solid rgba(255,255,255,0.03)}
        .brand{display:flex;align-items:center;gap:12px;margin-bottom:10px}
        .brand .logo{width:44px;height:44px;border-radius:10px;background:#fff url("{{ asset('images/Group-237.png') }}") center/cover no-repeat}
        .brand h2{font-size:18px;margin:0}
        .small{font-size:13px}
        .nav{margin-top:14px}
        .nav .section{margin-bottom:8px}
        .nav a{display:flex;align-items:center;gap:12px;padding:10px;border-radius:8px;color:var(--muted);text-decoration:none;margin-bottom:6px}
        .nav a.active, .nav a:hover{background:rgba(255,255,255,0.03);color:#fff}
        .nav a i{width:18px;text-align:center}
        .submenu{padding-left:12px;display:none;flex-direction:column;margin-top:6px}
        .submenu a{padding:8px 10px;font-size:14px}

        /* Main */
        .main{flex:1;padding:22px;height:100vh;overflow-y:auto;}
        header.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
        .topbar-left{display:flex;align-items:center;gap:14px}
        .search{display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.03);padding:8px;border-radius:10px}
        .search input{border:0;background:transparent;color:#fff;outline:none;width:260px}
        .actions{display:flex;gap:10px;align-items:center}
        .btn{background:transparent;border:1px solid rgba(255,255,255,0.06);padding:8px 12px;border-radius:10px;color:#e6eef6;cursor:pointer}
        .btn.primary{background:var(--accent);border:none;color:#07221a}
        .btn.pdf-view{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#ef4444}
        .icon-btn{background:transparent;border:0;color:var(--muted);font-size:18px;cursor:pointer}

        /* Layout */
        .panel{background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);border-radius:12px;padding:16px;border:1px solid rgba(255,255,255,0.03)}
        .panel h3{margin:0 0 10px}

        /* Forms */
        .form-row{display:flex;gap:16px;margin-bottom:15px}
        .form-col{flex:1}
        .input{width:100%;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:#e6eef6}
        .label{font-size:13px;color:var(--muted);margin-bottom:6px;display:block}
        .file-input{display:none}
        .file-label{display:flex;align-items:center;gap:8px;padding:10px;border-radius:8px;border:1px dashed rgba(255,255,255,0.04);cursor:pointer;color:var(--muted);transition:all 0.3s ease}
        .file-label:hover{background:rgba(255,255,255,0.03);border-color:rgba(255,255,255,0.1)}
        .file-label.has-file{border-color:var(--accent);background:rgba(16,185,129,0.05);color:#fff}
        .img-preview{width:100%;height:140px;object-fit:cover;border-radius:8px;background:#031224;display:block}
        .select{padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:#e6eef6;width:100%}
        .help{font-size:12px;color:var(--muted);margin-top:6px}

        /* Alert Messages */
        .alert {
          padding: 12px 15px;
          margin: 15px 0;
          border-radius: 8px;
          font-size: 14px;
        }
        .alert-error {
          background-color: rgba(239, 68, 68, 0.15);
          color: #ef4444;
          border: 1px solid rgba(239, 68, 68, 0.3);
        }
        .alert-success {
          background-color: rgba(16, 185, 129, 0.15);
          color: #10b981;
          border: 1px solid rgba(16, 185, 129, 0.3);
        }

        /* Tables */
        table{width:100%;border-collapse:collapse}
        th,td{padding:10px;text-align:left;border-bottom:1px solid rgba(255,255,255,0.03);font-size:14px}
        th{color:var(--muted);font-weight:600}

        /* Responsive */
        @media (max-width:1000px){.sidebar{display:none}.form-row{flex-direction:column}}
    </style>
</head>
<body>
    <div class="app">
        <aside class="sidebar">
            <div class="brand"><div class="logo"></div><h2>Sabra Admin</h2></div>
            <div class="small" style="color:var(--muted)">Manage site content</div>
            <nav class="nav">
                <div class="section">
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-house"></i> Dashboard
                    </a>
                </div>

                <div class="section">
                    <a href="#bookings" class="{{ request()->is('admin/bookings*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-check"></i> Bookings
                    </a>
                </div>

                <div class="section">
                    <a href="#events" class="{{ request()->is('admin/events*') || request()->routeIs('events.*') ? 'active' : '' }}">
                        <i class="fas fa-calendar-day"></i> Events
                    </a>
                </div>

                <div class="section">
                    <a href="#users" class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Users
                    </a>
                </div>
            </nav>
        </aside>

        <main class="main">
            <header class="topbar">
                <div class="topbar-left">
                    <h1 style="margin:0;font-size:20px">Admin</h1>
                    <div class="small" style="color:var(--muted)">Manage content</div>
                </div>

                <div class="actions">
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="text-align:right;margin-right:6px">
                            <div style="font-size:13px">{{ Auth::user()->name }}</div>
                            <div style="color:var(--muted);font-size:12px">{{ Auth::user()->email }}</div>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="btn">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST" style="margin:0">
                            @csrf
                            <button type="submit" class="btn">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
    
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.style.display = 'none', 500);
            });
        }, 5000);
    </script>
</body>
</html>
