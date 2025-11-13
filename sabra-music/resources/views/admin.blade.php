<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Admin • Sabra Music</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<style>
		:root{--bg:#0f1724;--panel:#0b1220;--muted:#9ca3af;--accent:#10b981;--card:#0b1226;--light-border: rgba(209,213,219,0.16)}
		*{box-sizing:border-box}

		/* unify border color and ensure UI parts show a light gray border */
		/* keep existing border widths/styles but force color to a single tone */
		* { border-color: var(--light-border) !important; }
		/* targeted fallback for elements that don't declare a border but should appear bordered */
		.panel, .card, .input, .select, .file-label, .btn, .tabs button, .sidebar, table, th, td { border: 1px solid var(--light-border) !important; }
		body{margin:0;font-family:Inter,ui-sans-serif,system-ui,Segoe UI,Roboto,Arial;background:linear-gradient(180deg,#0b1220 0%, #071022 100%);color:#e6eef6}
		.app{display:flex;min-height:100vh}

		/* Sidebar */
		.sidebar{width:260px;padding:20px 22px;background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);border-right:1px solid rgba(255,255,255,0.03)}
		.brand{display:flex;align-items:center;gap:12px;margin-bottom:10px}
		.brand .logo{width:44px;height:44px;border-radius:10px;background:#fff url("{{ asset('images/Group-237.png') }}") center/cover no-repeat}
		.brand h2{font-size:18px;margin:0}
		.small{font-size:13px}
		.nav{margin-top:24px}
		.nav .section{margin-bottom:12px}
		.nav a{display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:8px;color:var(--muted);text-decoration:none;margin-bottom:6px;transition:all 0.2s ease}
		.nav a.active, .nav a:hover{background:rgba(255,255,255,0.05);color:#fff}
		.nav a i{width:18px;text-align:center;font-size:16px}

		/* Main */
		.main{flex:1;padding:20px}
		header.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
		.topbar-left{display:flex;align-items:center;gap:14px}
		.search{display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.03);padding:8px;border-radius:10px}
		.search input{border:0;background:transparent;color:#fff;outline:none;width:260px}
		.actions{display:flex;gap:10px;align-items:center}
		.btn{background:transparent;border:1px solid rgba(255,255,255,0.06);padding:8px 12px;border-radius:10px;color:#e6eef6;cursor:pointer}

		/* Logout button styling (topbar) - distinct and readable */
		header.topbar .actions form .btn.logout-btn {
			background: rgba(239,68,68,0.12);
			border: 1px solid rgba(239,68,68,0.28) !important;
			color: #ffecec !important;
		}
		header.topbar .actions form .btn.logout-btn:hover {
			background: rgba(239,68,68,0.18);
			border-color: rgba(239,68,68,0.36) !important;
			transform: translateY(-2px);
		}
		header.topbar .actions form .btn.logout-btn:active { transform: translateY(-1px) scale(0.996); }
		header.topbar .actions form .btn.logout-btn:focus { box-shadow: 0 8px 20px rgba(239,68,68,0.12), 0 0 0 4px rgba(239,68,68,0.06); outline:none }
		.btn.primary{background:var(--accent);border:none;color:#07221a}
		.btn.pdf-view{background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#ef4444}
		.icon-btn{background:transparent;border:0;color:var(--muted);font-size:18px;cursor:pointer}

		/* Stats */
		.stats{display:flex;gap:14px;margin-bottom:18px}
		.card{flex:1;background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);border-radius:12px;padding:14px;border:1px solid rgba(255,255,255,0.03)}

		/* Gradient variants for stats */
		.card.gradient-bookings{background:linear-gradient(135deg, rgba(16,185,129,0.14), rgba(6,95,70,0.04));border:1px solid rgba(16,185,129,0.18)}
		.card.gradient-events{background:linear-gradient(135deg, rgba(249,115,22,0.14), rgba(220,38,38,0.04));border:1px solid rgba(249,115,22,0.16)}
		.card.gradient-users{background:linear-gradient(135deg, rgba(99,102,241,0.14), rgba(79,70,229,0.04));border:1px solid rgba(99,102,241,0.14)}
		.card .label{color:var(--muted);font-size:13px}
		.card .value{font-size:20px;margin-top:6px}

		/* Layout */
		.grid{display:grid;grid-template-columns:1fr 380px;gap:20px}
		.panel{background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);border-radius:12px;padding:16px;border:1px solid rgba(255,255,255,0.03)}
		.panel h3{margin:0 0 10px}

		/* Tables */
		table{width:100%;border-collapse:collapse}
		th,td{padding:10px;text-align:left;border-bottom:1px solid rgba(255,255,255,0.03);font-size:14px}
		/* Make table headers visually distinct as headings */
		table thead th {
			background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01));
			color: #f8fafc; /* brighter heading color */
			font-weight:700;
			text-transform:uppercase;
			letter-spacing:0.6px;
			font-size:13px;
			padding:12px 10px;
			border-bottom:2px solid rgba(255,255,255,0.06);
		}
		th{color:var(--muted);font-weight:600}

		/* Events & bookings tabs */
		.tabs{display:flex;gap:8px;margin-bottom:12px}
		.tabs button{padding:8px 10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:var(--muted);cursor:pointer}
		.tabs button.active{background:rgba(255,255,255,0.03);color:#fff}

		/* Forms - Create Event */
		.form-row{display:flex;gap:8px}
		.form-col{flex:1}
		.input{width:100%;padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:#e6eef6}
		.label{font-size:13px;color:var(--muted);margin-bottom:6px;display:block}
		.file-input{display:none}
		.file-label{display:flex;align-items:center;gap:8px;padding:10px;border-radius:8px;border:1px dashed rgba(255,255,255,0.04);cursor:pointer;color:var(--muted);transition:all 0.3s ease}
		.file-label:hover{background:rgba(255,255,255,0.03);border-color:rgba(255,255,255,0.1)}
		.file-label.has-file{border-color:var(--accent);background:rgba(16,185,129,0.05);color:#fff}
		.img-preview{width:100%;height:140px;object-fit:cover;border-radius:8px;background:#031224;display:block}
		.select{padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:#e6eef6}

		/* Scoped: keep the Create Event status dropdown the same width but use a dark theme and readable options */
		#createEventPanel #evt-status.select {
			/* do not set width here so the element retains its layout width */
			background: linear-gradient(180deg, rgba(12,14,20,0.92), rgba(8,10,14,0.94));
			color: #e6eef6;
			border: 1px solid rgba(255,255,255,0.06) !important;
			padding: 10px 36px 10px 10px; /* room for custom arrow on the right */
			border-radius: 8px;
			appearance: none; -webkit-appearance: none; -moz-appearance: none;
			background-repeat: no-repeat;
			background-position: calc(100% - 12px) center;
			background-size: 12px 12px;
			/* subtle arrow using SVG data URI for crispness on dark backgrounds */
			background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23e6eef6' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>");
		}

		/* Ensure option text remains readable where browsers allow styling */
		#createEventPanel #evt-status.select option {
			background: #0b1220; /* dark fallback for option background */
			color: #e6eef6;
		}

		/* Focus state (does not change width) */
		#createEventPanel #evt-status.select:focus {
			outline: none;
			box-shadow: 0 6px 18px rgba(2,6,23,0.6), 0 0 0 4px rgba(16,185,129,0.04);
		}
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
		<script>
		// Scroll direction detector - toggles body.scrolling-up / body.scrolling-down
		(function(){
			if (typeof window === 'undefined') return;
			const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			if (prefersReduced) return;

			let lastY = window.scrollY || 0;
			let ticking = false;

			function onScroll(){
				const y = window.scrollY || 0;
				if (!ticking){
					window.requestAnimationFrame(() => {
						if (Math.abs(y - lastY) > 10){
							if (y > lastY) { document.body.classList.add('scrolling-down'); document.body.classList.remove('scrolling-up'); }
							else { document.body.classList.add('scrolling-up'); document.body.classList.remove('scrolling-down'); }
							lastY = y;
						}
						ticking = false;
					});
					ticking = true;
				}
			}

			window.addEventListener('scroll', onScroll, { passive: true });
		})();
		</script>

		.alert-success {
		  background-color: rgba(16, 185, 129, 0.15);
		  color: #10b981;
		  border: 1px solid rgba(16, 185, 129, 0.3);
		}

		/* Recent booking highlight */
		.booking-row.recent{animation: highlight-fade 3s ease-out}
		@keyframes highlight-fade {
			0% { background-color: rgba(16, 185, 129, 0.15); }
			100% { background-color: transparent; }
		}
		
		/* Responsive */
		@media (max-width:1000px){.sidebar{display:none}.grid{grid-template-columns:1fr}.form-row{flex-direction:column}}

		/* Animations */
		@keyframes revealUp {
			0% { opacity: 0; transform: translateY(50px); }
			100% { opacity: 1; transform: translateY(0); }
		}
		@keyframes softPulse {
			0% { transform: scale(1); opacity: 1; }
			50% { transform: scale(1.03); opacity: 0.96; }
			100% { transform: scale(1); opacity: 1; }
		}
		/* quicker reveal */
		.reveal { animation: revealUp 500ms cubic-bezier(.22,.9,.28,1) forwards; }
		/* snappier pulse */
		.pulse { animation: softPulse 1800ms ease-in-out infinite; }
		.fade-in { opacity: 0; animation: revealUp 420ms ease forwards; }
		/* small lift on hover for interactive cards */
		.panel, .card { transition: transform .18s ease, box-shadow .18s ease; }
		.panel:hover, .card:hover { transform: translateY(-4px); box-shadow: 0 14px 30px rgba(2,6,23,0.45); }

		/* Hover animations for most interactive components */
		.nav a, .panel, .card, .btn, .tabs button, .file-label, .brand, .search, .panel .btn, table tr td { will-change: transform, box-shadow, background; }
		.nav a:hover, .btn:hover, .tabs button:hover, .file-label:hover, .brand:hover, .search:hover { transform: translateY(-3px) scale(1.01); box-shadow: 0 10px 22px rgba(2,6,23,0.25); }
		table tbody tr:hover td { background: rgba(30, 22, 139, 0.11); }

		/* Elements that react to scroll direction (small directional nudge) */
		/* gentler scroll-direction nudges */
		.scroll-react { transition: transform 600ms cubic-bezier(.2,.9,.2,1); }
		body.scrolling-down .scroll-react { transform: translateY(-3px); }
		body.scrolling-up .scroll-react { transform: translateY(3px); }

		@media (prefers-reduced-motion: reduce) {
			.nav a:hover, .btn:hover, .tabs button:hover, .file-label:hover, .brand:hover, .search:hover { transform: none !important; box-shadow: none !important; }
			.scroll-react, .panel, .card { transition: none !important; transform: none !important; }
		}

		/* Respect users who prefer reduced motion */
		@media (prefers-reduced-motion: reduce) {
			.reveal, .pulse, .fade-in { animation: none !important; }
			.panel, .card { transition: none !important; transform: none !important; box-shadow: none !important; }
		}

		/* Quick Actions - darker, richer button gradients (scoped) */
		#quick-actions .btn {
			display:block;
			width:100%;
			text-align:center;
			padding:10px 12px;
			border-radius:10px;
			color:#fff !important;
			text-decoration:none;
			border:1px solid rgba(255,255,255,0.04) !important;
			background:linear-gradient(180deg, rgba(0,0,0,0.35), rgba(0,0,0,0.25));
			box-shadow: 0 6px 18px rgba(2,6,23,0.5), inset 0 -2px 0 rgba(0,0,0,0.25);
			transition: transform .14s ease, box-shadow .14s ease, filter .14s ease;
		}

		/* Individual button tones (Bookings: deep green, Events: deep amber, Users: deep indigo) */
		#quick-actions .btn:nth-of-type(1) {
			background: linear-gradient(180deg, #044d37 0%, #063826 100%);
			border-color: rgba(4,77,55,0.6) !important;
		}
		#quick-actions .btn:nth-of-type(2) {
			background: linear-gradient(180deg, #7a2f0b 0%, #5a2306 100%);
			border-color: rgba(122,47,11,0.6) !important;
		}
		#quick-actions .btn:nth-of-type(3) {
			background: linear-gradient(180deg, #2f2aa8 0%, #26226f 100%);
			border-color: rgba(47,42,168,0.6) !important;
		}

		#quick-actions .btn:hover {
			transform: translateY(-3px) scale(1.01);
			box-shadow: 0 18px 40px rgba(2,6,23,0.65), inset 0 -3px 0 rgba(0,0,0,0.35);
			filter: brightness(1.06);
		}

		#quick-actions .btn:active {
			transform: translateY(-1px) scale(0.997);
			filter: brightness(0.98);
		}

		#quick-actions .btn:focus {
			outline: none;
			box-shadow: 0 8px 24px rgba(2,6,23,0.5), 0 0 0 4px rgba(255,255,255,0.03);
		}

		/* Create Event - 3D, sharp bordered controls (no new colors; widths unchanged) */
		#createEventPanel .input,
		#createEventPanel textarea.input,
		#createEventPanel .select,
		#createEventPanel #evt-status.select,
		#createEventPanel .file-label,
		#createEventPanel .img-preview {
			/* keep existing color/background; do not introduce new color fills */
			background: transparent !important;
			color: inherit !important;
			border: 1px solid rgba(209,213,219,0.32) !important; /* sharp visible border */
			border-radius: 8px;
			box-shadow: 0 8px 22px rgba(2,6,23,0.6), inset 0 1px 0 rgba(255,255,255,0.02);
			transition: transform .14s ease, box-shadow .14s ease, border-color .12s ease;
			/* do not change width here to preserve layout */
		}

		/* Hover/focus produce a small 3D lift without changing size */
		#createEventPanel .input:hover,
		#createEventPanel textarea.input:hover,
		#createEventPanel .select:hover,
		#createEventPanel .file-label:hover,
		#createEventPanel .img-preview:hover { transform: translateY(-4px); box-shadow: 0 18px 40px rgba(2,6,23,0.72); }

		#createEventPanel .input:focus,
		#createEventPanel textarea.input:focus,
		#createEventPanel .select:focus,
		#createEventPanel #evt-status.select:focus,
		#createEventPanel .file-label:focus {
			outline: none;
			transform: translateY(-3px);
			box-shadow: 0 20px 44px rgba(2,6,23,0.8), inset 0 1px 0 rgba(255,255,255,0.02);
			border-color: rgba(209,213,219,0.42) !important;
		}

		/* File label should be solid bordered and not dashed for sharpness */
		#createEventPanel .file-label { border-style: solid !important; }

		/* Image preview gets a clear border and subtle elevation */
		#createEventPanel .img-preview { display:block; border-radius:8px; border:1px solid rgba(209,213,219,0.32) !important; box-shadow: 0 10px 28px rgba(2,6,23,0.6); }
	</style>
</head>
<body>
	<div class="app">
		<aside class="sidebar">
			<div class="brand"><div class="logo"></div><h2>Sabra Admin</h2></div>
			<div class="small" style="color:var(--muted)">Manage site content</div>
			<nav class="nav">
				<div class="section">
					<a href="#dashboard" class="active" data-target="dashboard"><i class="fas fa-house"></i> Dashboard</a>
				</div>

				<div class="section">
					<a href="#bookings" data-target="bookings"><i class="fas fa-calendar-check"></i> Bookings</a>
				</div>

				<div class="section">
					<a href="#events" data-target="events"><i class="fas fa-calendar-day"></i> Events</a>
				</div>

				<div class="section">
					<a href="#users" data-target="users"><i class="fas fa-users"></i> Users</a>
				</div>
			</nav>
		</aside>

		<main class="main">
			<header class="topbar">
				<div class="topbar-left">
					<h1 style="margin:0;font-size:20px">Dashboard</h1>
					<div class="small" style="color:var(--muted)">Welcome back</div>
				</div>

				<div class="actions">
					<div class="search"><i class="fas fa-search" style="opacity:0.6"></i><input placeholder="Search events, users, bookings..." /></div>
					<button class="icon-btn" title="Notifications"><i class="fas fa-bell"></i></button>
					<div style="display:flex;align-items:center;gap:10px">
						<div style="text-align:right;margin-right:6px">
							<div style="font-size:13px">{{ Auth::user()->name }}</div>
							<div style="color:var(--muted);font-size:12px">{{ Auth::user()->email }}</div>
						</div>
						<form action="{{ route('logout') }}" method="POST" style="margin:0">
							@csrf
							<button type="submit" class="btn logout-btn">Logout</button>
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

			<!-- Stats -->
			<div class="stats">
				<div class="card gradient-bookings">
					<div class="label">Total Bookings</div>
					<div class="value">{{ $stats['bookings'] }}</div>
				</div>
				<div class="card gradient-events">
					<div class="label">Total Events</div>
					<div class="value">{{ $stats['events'] }}</div>
				</div>
				<div class="card gradient-users">
					<div class="label">Total Users</div>
					<div class="value">{{ $stats['users'] }}</div>
				</div>
			</div>

			<div class="grid">
				<section>
					<div class="panel" id="dashboard">
						<h3>Analytics</h3>
						<div style="display:flex;gap:12px;align-items:stretch;margin-top:12px">
							<div style="flex:1;padding:12px;border-radius:8px;background:rgba(255, 255, 255, 0.06);min-height:160px">
								<div style="color:var(--muted);font-size:13px">Bookings per month</div>
								<div style="height:130px;border-radius:6px;margin-top:8px;position:relative">
									<canvas id="bookingsChart"></canvas>
								</div>
							</div>
							<div style="width:220px;padding:12px;border-radius:8px;background:rgba(255, 255, 255, 0.06);min-height:160px">
								<div style="color:var(--muted);font-size:13px">Event participation</div>
								<div style="height:130px;border-radius:6px;margin-top:8px;position:relative">
									<canvas id="eventsChart"></canvas>
								</div>
							</div>
						</div>

						<div style="height:16px"></div>

						<h3 style="margin-top:6px">Recent Activities</h3>
						<div style="margin-top:8px;overflow:auto">
							<table>
								<thead>
									<tr><th>Time</th><th>Activity</th><th>User</th><th></th></tr>
								</thead>
								<tbody>
									@forelse($recent_activities as $activity)
										<tr>
											<td>{{ $activity['time']->diffForHumans() }}</td>
											<td>{{ $activity['activity'] }}</td>
											<td>{{ $activity['user'] }}</td>
											<td style="text-align:right;color:var(--muted)">
												@if($activity['type'] == 'booking')
													<a href="{{ route('admin.bookings.show', $activity['id']) }}" style="color:var(--muted)">Details</a>
													@php
														$booking = \App\Models\Booking::find($activity['id']);
													@endphp
													@if($booking && $booking->pdf_attachment)
														<a href="{{ route('admin.bookings.pdf', $activity['id']) }}" style="color:var(--accent)" target="_blank">View PDF</a>
													@endif
												@elseif($activity['type'] == 'event')
													<a href="{{ route('events.show', $activity['id']) }}" style="color:var(--muted)">View</a>
												@endif
											</td>
										</tr>
									@empty
										<tr><td colspan="4" style="text-align:center;color:var(--muted)">No recent activities</td></tr>
									@endforelse
								</tbody>
							</table>
						</div>
					</div>
				</section>

				<aside>
					<div class="panel" id="quick-actions">
						<h3>Quick Actions</h3>
						<div style="display:flex;flex-direction:column;gap:8px;margin-top:10px">
							<a href="#bookings" class="btn" style="text-align:center;text-decoration:none">View Bookings</a>
							<a href="#events" class="btn" style="text-align:center;text-decoration:none">Manage Events</a>
							<a href="#users" class="btn" style="text-align:center;text-decoration:none">Manage Users</a>
						</div>
					</div>

					<div style="height:12px"></div>

					<div class="panel" id="createEventPanel">
						<h3>Create Event</h3>
						<form id="createForm" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" style="margin-top:12px">
							@csrf
							<div class="form-row">
								<div class="form-col">
									<label class="label">Title</label>
									<input class="input" id="evt-title" name="title" type="text" placeholder="Event title" required value="{{ old('title') }}">
									@error('title')
										<div style="color:#ef4444;font-size:12px;margin-top:5px">{{ $message }}</div>
									@enderror

									<label class="label" style="margin-top:8px">Date</label>
									<input class="input" id="evt-date" name="event_date" type="date" required value="{{ old('event_date') }}">
									@error('event_date')
										<div style="color:#ef4444;font-size:12px;margin-top:5px">{{ $message }}</div>
									@enderror

									<label class="label" style="margin-top:8px">Time</label>
									<input class="input" id="evt-time" name="event_time" type="time" required value="{{ old('event_time') }}">
									@error('event_time')
										<div style="color:#ef4444;font-size:12px;margin-top:5px">{{ $message }}</div>
									@enderror

									<label class="label" style="margin-top:8px">Location</label>
									<input class="input" id="evt-location" name="location" type="text" placeholder="Location" required value="{{ old('location') }}">
									@error('location')
										<div style="color:#ef4444;font-size:12px;margin-top:5px">{{ $message }}</div>
									@enderror

									<label class="label" style="margin-top:8px">Status</label>
									<select id="evt-status" name="status" class="select">
										<option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
										<option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
									</select>
									@error('status')
										<div style="color:#ef4444;font-size:12px;margin-top:5px">{{ $message }}</div>
									@enderror
								</div>

								<div style="width:220px">
									<label class="label">Cover Image</label>
									<img id="imgPreview" class="img-preview" src="{{ asset('images/bg1.jpg') }}" alt="image preview">
									<label class="file-label" style="margin-top:8px">
										<i class="fas fa-upload"></i>
										<span id="fileLabelText">Choose image</span>
										<input id="imgInput" name="image" class="file-input" type="file" accept="image/jpeg,image/png,image/jpg">
									</label>
									<button type="button" id="clearImage" style="margin-top:4px;font-size:12px;background:transparent;border:0;color:var(--muted);cursor:pointer;padding:0;display:none;">
										<i class="fas fa-times"></i> Clear image
									</button>
									<div class="help">Recommended size: 1200x600px. JPG or PNG.</div>
									@error('image')
										<div style="color:#ef4444;font-size:12px;margin-top:5px">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<label class="label" style="margin-top:10px">Description</label>
							<textarea id="evt-desc" name="description" class="input" style="min-height:120px" placeholder="Short description" required>{{ old('description') }}</textarea>
							@error('description')
								<div style="color:#ef4444;font-size:12px;margin-top:5px">{{ $message }}</div>
							@enderror

							<div style="display:flex;gap:8px;margin-top:12px">
								<button type="submit" name="submit_type" value="publish" id="publishBtn" class="btn primary">Publish</button>
								<button type="submit" name="submit_type" value="draft" id="saveDraftBtn" class="btn">Save Draft</button>
							</div>
						</form>
					</div>
				</aside>
			</div>

			<!-- Bookings section (anchor) -->
			<div style="margin-top:18px" id="bookings">
				<div class="panel">
					<h3>Bookings</h3>
					<div class="tabs" style="margin-top:10px">
						<button class="active" data-tab="all">All</button>
						<button data-tab="pending">Pending</button>
						<button data-tab="approved">Approved</button>
						<button data-tab="rejected">Rejected</button>
					</div>
					<div class="tab-content" style="margin-top:8px">
						<table>
							<thead><tr><th>User</th><th>Center</th><th>Booking Date</th><th>Time</th><th>Created</th><th>Status</th><th>Actions</th></tr></thead>
							<tbody id="bookingTableBody">
								@forelse($bookings as $index => $booking)
									<tr class="booking-row {{ $index < 3 ? 'recent' : '' }}" data-status="{{ $booking->status }}">
										<td>{{ $booking->user->email }}</td>
										<td>{{ $booking->center->name }}</td>
										<td>{{ $booking->booking_date }}</td>
										<td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
										<td title="{{ $booking->created_at }}">{{ $booking->created_at->diffForHumans() }}</td>
										<td>
											<span class="status-badge" style="padding:3px 8px;border-radius:12px;font-size:12px;
												background-color:{{ $booking->status == 'pending' ? 'rgba(234,179,8,0.2)' : ($booking->status == 'approved' ? 'rgba(16,185,129,0.2)' : 'rgba(239,68,68,0.2)') }};
												color:{{ $booking->status == 'pending' ? '#eab308' : ($booking->status == 'approved' ? '#10b981' : '#ef4444') }}">
												{{ ucfirst($booking->status) }}
											</span>
										</td>
										<td>
											<a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn">Details</a>
											@if($booking->pdf_attachment)
												<a href="{{ route('admin.bookings.pdf', $booking->id) }}" class="btn pdf-view" target="_blank"><i class="fas fa-file-pdf"></i> View</a>
											@endif
											<form action="{{ route('admin.bookings.status', $booking->id) }}" method="POST" style="display:inline">
												@csrf
												@method('PATCH')
												@if($booking->status != 'approved')
													<button type="submit" name="status" value="approved" class="btn" style="color:#10b981">Approve</button>
												@endif
												@if($booking->status != 'rejected')
													<button type="submit" name="status" value="rejected" class="btn" style="color:#ef4444">Reject</button>
												@endif
											</form>
										</td>
									</tr>
								@empty
									<tr><td colspan="7" style="text-align:center;color:var(--muted)">No bookings found</td></tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- Events management -->
			<div style="margin-top:18px" id="events">
				<div class="panel">
					<h3>Events</h3>
					<div class="tabs" style="margin-top:10px">
						<button class="active" data-tab="upcoming-tab">Upcoming</button>
						<button data-tab="past-tab">Past</button>
					</div>
					<div class="tab-content" style="margin-top:10px" id="upcoming-tab">
						<table>
							<thead><tr><th>Title</th><th>Date</th><th>Photo</th><th>Status</th><th>Actions</th></tr></thead>
							<tbody>
								@forelse($upcoming_events as $event)
									<tr>
										<td>{{ $event->title }}</td>
										<td>{{ $event->event_date }} {{ $event->event_time }}</td>
										<td>
											@if($event->image)
												<img src="{{ Storage::url($event->image) }}" style="width:80px;height:40px;object-fit:cover;border-radius:6px"/>
											@else
												<img src="{{ asset('images/bg1.jpg') }}" style="width:80px;height:40px;object-fit:cover;border-radius:6px"/>
											@endif
										</td>
										<td>
											<span style="padding:3px 8px;border-radius:12px;font-size:12px;
												background-color:{{ $event->status == 'draft' ? 'rgba(234,179,8,0.2)' : 'rgba(16,185,129,0.2)' }};
												color:{{ $event->status == 'draft' ? '#eab308' : '#10b981' }}">
												{{ ucfirst($event->status) }}
											</span>
										</td>
										<td>
											<a href="{{ route('events.edit', $event->id) }}" class="btn"><i class="fas fa-edit"></i></a>
											<form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this event?')"><i class="fas fa-trash"></i></button>
											</form>
										</td>
									</tr>
								@empty
									<tr><td colspan="5" style="text-align:center;color:var(--muted)">No upcoming events found</td></tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<div class="tab-content" style="margin-top:10px;display:none" id="past-tab">
						<table>
							<thead><tr><th>Title</th><th>Date</th><th>Photo</th><th>Status</th><th>Actions</th></tr></thead>
							<tbody>
								@forelse($past_events as $event)
									<tr>
										<td>{{ $event->title }}</td>
										<td>{{ $event->event_date }} {{ $event->event_time }}</td>
										<td>
											@if($event->image)
												<img src="{{ Storage::url($event->image) }}" style="width:80px;height:40px;object-fit:cover;border-radius:6px"/>
											@else
												<img src="{{ asset('images/bg1.jpg') }}" style="width:80px;height:40px;object-fit:cover;border-radius:6px"/>
											@endif
										</td>
										<td>
											<span style="padding:3px 8px;border-radius:12px;font-size:12px;
												background-color:{{ $event->status == 'draft' ? 'rgba(234,179,8,0.2)' : 'rgba(16,185,129,0.2)' }};
												color:{{ $event->status == 'draft' ? '#eab308' : '#10b981' }}">
												{{ ucfirst($event->status) }}
											</span>
										</td>
										<td>
											<a href="{{ route('events.edit', $event->id) }}" class="btn"><i class="fas fa-edit"></i></a>
											<form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this event?')"><i class="fas fa-trash"></i></button>
											</form>
										</td>
									</tr>
								@empty
									<tr><td colspan="5" style="text-align:center;color:var(--muted)">No past events found</td></tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- Users -->
			<div style="margin-top:18px" id="users">
				<div class="panel">
					<h3>Users</h3>
					<div style="margin-top:10px;overflow:auto">
						<table>
							<thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Actions</th></tr></thead>
							<tbody>
								@forelse($users as $user)
									<tr>
										<td>{{ $user->name }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ ucfirst($user->role) }}</td>
										<td>Active</td>
										<td>
											<a href="#" class="btn edit-user-btn" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}" data-user-role="{{ $user->role }}">
												<i class="fas fa-edit"></i> Edit
											</a>
										</td>
									</tr>
								@empty
									<tr><td colspan="5" style="text-align:center;color:var(--muted)">No users found</td></tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</main>
	</div>

	<script>
		// Navigation functionality
		document.querySelectorAll('.nav .section > a').forEach(a => {
			a.addEventListener('click', (e) => {
				// Mark the clicked link as active
				document.querySelectorAll('.nav .section > a').forEach(link => {
					link.classList.remove('active');
				});
				a.classList.add('active');
			});
		});
		
		// Event form validation and submission
		document.addEventListener('DOMContentLoaded', function() {
			const createForm = document.getElementById('createForm');
			const publishBtn = document.getElementById('publishBtn');
			const saveDraftBtn = document.getElementById('saveDraftBtn');
			
			if (createForm) {
				// Set Publish button to select published status
				publishBtn.addEventListener('click', function() {
					document.getElementById('evt-status').value = 'published';
				});
				
				// Set Save Draft button to select draft status
				saveDraftBtn.addEventListener('click', function() {
					document.getElementById('evt-status').value = 'draft';
				});
				
				// Form validation
				createForm.addEventListener('submit', function(e) {
					const title = document.getElementById('evt-title').value;
					const date = document.getElementById('evt-date').value;
					const time = document.getElementById('evt-time').value;
					const location = document.getElementById('evt-location').value;
					const description = document.getElementById('evt-desc').value;
					const imageFile = document.getElementById('imgInput').files[0];
					
					// Check required fields
					if (!title || !date || !time || !location || !description) {
						e.preventDefault();
						alert('Please fill in all required fields');
						return;
					}
					
					// Validate image if one is selected
					if (imageFile) {
						// Check file size (max 5MB)
						const maxSize = 5 * 1024 * 1024; // 5MB in bytes
						if (imageFile.size > maxSize) {
							e.preventDefault();
							alert('Image file is too large. Maximum size is 5MB.');
							return;
						}
						
						// Check file type
						const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
						if (!validTypes.includes(imageFile.type)) {
							e.preventDefault();
							alert('Invalid file type. Please upload a JPG or PNG image.');
							return;
						}
					}
				});
			}
		});

		// Tabs
		document.querySelectorAll('.tabs').forEach(tabGroup => {
			tabGroup.querySelectorAll('button').forEach(btn => btn.addEventListener('click', () => {
				btn.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('active'));
				btn.classList.add('active');
				
				// Handle event tabs
				if (btn.getAttribute('data-tab') === 'upcoming-tab') {
					document.getElementById('upcoming-tab').style.display = 'block';
					document.getElementById('past-tab').style.display = 'none';
				} else if (btn.getAttribute('data-tab') === 'past-tab') {
					document.getElementById('upcoming-tab').style.display = 'none';
					document.getElementById('past-tab').style.display = 'block';
				}
				
				// Handle booking tabs
				if (tabGroup.closest('#bookings')) {
					const status = btn.getAttribute('data-tab');
					const rows = document.querySelectorAll('.booking-row');
					
					rows.forEach(row => {
						if (status === 'all') {
							row.style.display = 'table-row';
						} else {
							row.style.display = row.getAttribute('data-status') === status ? 'table-row' : 'none';
						}
					});
				}
			}));
		});

		// Quick open
		function openSection(id){
			const el = document.getElementById(id);
			if (el){ el.scrollIntoView({behavior:'smooth', block:'start'}); el.style.transition='background 0.3s'; el.style.background='rgba(255,255,255,0.01)'; setTimeout(()=>el.style.background='transparent',700); }
		}

		// Image preview for Create Event form
		const imgInput = document.getElementById('imgInput');
		const imgPreview = document.getElementById('imgPreview');
		const fileLabelText = document.getElementById('fileLabelText');
		const clearImageBtn = document.getElementById('clearImage');
		const defaultPreviewSrc = imgPreview ? imgPreview.src : '';
		
		function updateImagePreview(file) {
			if (!imgPreview) return;
			
			if (file) {
				// Update file name display
				fileLabelText.innerText = file.name.length > 20 
					? file.name.substring(0, 17) + '...' 
					: file.name;
				
				// Show image preview
				const reader = new FileReader();
				reader.onload = () => {
					imgPreview.src = reader.result;
					imgPreview.style.display = 'block';
				};
				reader.readAsDataURL(file);
				
				// Add a class to show file is selected
				document.querySelector('.file-label').classList.add('has-file');
				
				// Show clear button
				if (clearImageBtn) {
					clearImageBtn.style.display = 'block';
				}
			} else {
				// Reset to default
				imgPreview.src = defaultPreviewSrc;
				fileLabelText.innerText = 'Choose image';
				document.querySelector('.file-label').classList.remove('has-file');
				
				// Hide clear button
				if (clearImageBtn) {
					clearImageBtn.style.display = 'none';
				}
			}
		}
		
		if (imgInput) {
			// Handle file selection
			imgInput.addEventListener('change', (e) => {
				const file = e.target.files && e.target.files[0];
				if (!file) return;
				updateImagePreview(file);
			});
			
			// Make sure clicking anywhere on the label opens file dialog
			document.querySelectorAll('.file-label').forEach(lbl => {
				lbl.addEventListener('click', (e) => {
					// Prevent default if clicking on the input itself
					if (e.target !== imgInput) {
						e.preventDefault();
						imgInput.click();
					}
				});
			});
			
			// Clear button functionality
			if (clearImageBtn) {
				clearImageBtn.addEventListener('click', () => {
					// Reset file input
					imgInput.value = '';
					updateImagePreview(null);
				});
			}
		}

		// Auto-hide alerts after 5 seconds
		setTimeout(() => {
			const alerts = document.querySelectorAll('.alert');
			alerts.forEach(alert => {
				alert.style.transition = 'opacity 0.5s';
				alert.style.opacity = '0';
				setTimeout(() => alert.style.display = 'none', 500);
			});
		}, 5000);

		// Reveal panels/cards when they enter the viewport and replay on subsequent scrolls.
		// Also animate stat counters when their card becomes visible.
		document.addEventListener('DOMContentLoaded', function() {
			const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
			const panels = Array.from(document.querySelectorAll('.panel, .card'));
			// initialize hidden
			panels.forEach(p => { p.style.opacity = 0; });

			if (prefersReduced) {
				// If user prefers reduced motion, just make elements visible without animations
				panels.forEach(p => { p.style.opacity = 1; p.classList.remove('reveal'); });
				// Ensure counters show their final values
				document.querySelectorAll('.card .value').forEach(el => { el.textContent = el.textContent.trim(); });
				return;
			}

			function animateCounter(el, duration = 700) {
				if (!el) return;
				// If counter already played, don't animate again
				if (el._animating || el._played) return;
				const target = parseInt(el.textContent.trim()) || 0;
				if (target <= 0) { el.textContent = target; el._played = true; return; }
				el._animating = true;
				const startTime = performance.now();
				function step(now) {
					const progress = Math.min((now - startTime) / duration, 1);
					el.textContent = Math.floor(progress * target);
					if (progress < 1) requestAnimationFrame(step);
					else { el.textContent = target; el._animating = false; el._played = true; }
				}
				requestAnimationFrame(step);
			}

			const observer = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					const el = entry.target;
					if (entry.isIntersecting) {
						// add reveal and make visible
						el.classList.add('reveal');
						el.style.opacity = 1;
						// animate counter if present
						if (el.classList.contains('card')) {
							const val = el.querySelector('.value');
							if (val) animateCounter(val, 700);
						}
					} else {
						// remove reveal so the animation can replay visually when re-entering
						el.classList.remove('reveal');
						// reset visibility so the reveal plays when re-entered
						el.style.opacity = 0;
						// Do NOT reset stat counters here — they should remain the calculated values
					}
				});
			}, { threshold: 0.15 });

			panels.forEach(p => observer.observe(p));

			// For elements already in view on load, reveal them with a small stagger
			panels.forEach((p, i) => {
				const rect = p.getBoundingClientRect();
				if (rect.top < window.innerHeight && rect.bottom > 0) {
					setTimeout(() => {
						p.classList.add('reveal');
						p.style.opacity = 1;
							if (p.classList.contains('card')) {
								const v = p.querySelector('.value');
								if (v) animateCounter(v, 700);
							}
					}, 80 * i);
				}
			});
		});
	</script>
	
	<!-- User Edit Modal -->
	<div id="userEditModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:1000; align-items:center; justify-content:center;">
		<div style="background:var(--panel); width:450px; border-radius:12px; padding:25px; border:1px solid rgba(255,255,255,0.05); box-shadow:0 10px 30px rgba(0,0,0,0.3);">
			<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
				<h3 style="margin:0;">Edit User</h3>
				<button id="closeUserEditModal" style="background:transparent; border:none; color:var(--muted); font-size:18px; cursor:pointer;">
					<i class="fas fa-times"></i>
				</button>
			</div>
			
			<form id="userEditForm" action="" method="POST">
				@csrf
				@method('PUT')
				
				<div style="margin-bottom:15px;">
					<label class="label">Name</label>
					<input type="text" name="name" id="edit-user-name" class="input" required>
				</div>
				
				<div style="margin-bottom:15px;">
					<label class="label">Email</label>
					<input type="email" name="email" id="edit-user-email" class="input" required>
				</div>
				
				<div style="margin-bottom:15px;">
					<label class="label">Role</label>
					<select name="role" id="edit-user-role" class="select">
						<option value="user">User</option>
						<option value="admin">Admin</option>
					</select>
				</div>
				
				<div style="margin-bottom:15px;">
					<label class="label">Status</label>
					<select name="is_active" id="edit-user-status" class="select">
						<option value="1">Active</option>
						<option value="0">Inactive</option>
					</select>
				</div>
				
				<div style="margin-top:20px; display:flex; gap:10px; justify-content:flex-end;">
					<button type="button" id="cancelUserEdit" class="btn">Cancel</button>
					<button type="submit" class="btn primary">Save Changes</button>
				</div>
			</form>
		</div>
	</div>
	
	<script>
		// User Edit Modal Functionality
		document.addEventListener('DOMContentLoaded', function() {
			const modal = document.getElementById('userEditModal');
			const closeBtn = document.getElementById('closeUserEditModal');
			const cancelBtn = document.getElementById('cancelUserEdit');
			const editForm = document.getElementById('userEditForm');
			const editButtons = document.querySelectorAll('.edit-user-btn');
			
			// Open modal when edit button is clicked
			editButtons.forEach(button => {
				button.addEventListener('click', function(e) {
					e.preventDefault();
					
					// Get user data from data attributes
					const userId = this.getAttribute('data-user-id');
					const userName = this.getAttribute('data-user-name');
					const userEmail = this.getAttribute('data-user-email');
					const userRole = this.getAttribute('data-user-role');
					
					// Set form action URL
					editForm.action = "{{ url('/admin/users/') }}/" + userId;
					
					// Set form field values
					document.getElementById('edit-user-name').value = userName;
					document.getElementById('edit-user-email').value = userEmail;
					document.getElementById('edit-user-role').value = userRole;
					
					// Show the modal
					modal.style.display = 'flex';
				});
			});
			
			// Close modal functions
			const closeModal = () => {
				modal.style.display = 'none';
			};
			
			closeBtn.addEventListener('click', closeModal);
			cancelBtn.addEventListener('click', closeModal);
			
			// Close when clicking outside the modal
			modal.addEventListener('click', function(e) {
				if (e.target === modal) {
					closeModal();
				}
			});
		});

		// Initialize Charts
		document.addEventListener('DOMContentLoaded', function() {
			// Get booking data for chart
			const bookingData = @json($bookingsByMonth ?? []);
			
			// Process booking data for chart
			const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			const currentYear = new Date().getFullYear();
			const bookingCounts = new Array(12).fill(0);
			
			// If we have actual data, fill in the counts
			if (bookingData.length > 0) {
				bookingData.forEach(item => {
					const monthIndex = parseInt(item.month) - 1;
					bookingCounts[monthIndex] = parseInt(item.count);
				});
			}
			
			// Create Bookings Chart
			const bookingsChartElement = document.getElementById('bookingsChart');
			if (bookingsChartElement) {
				new Chart(bookingsChartElement, {
					type: 'bar',
					data: {
						labels: months,
						datasets: [{
							label: 'Bookings',
							data: bookingCounts,
							backgroundColor: 'rgba(16, 185, 129, 0.5)',
							borderColor: '#10b981',
							borderWidth: 1,
							borderRadius: 4,
							barPercentage: 0.6
						}]
					},
					options: {
						responsive: true,
						maintainAspectRatio: false,
						scales: {
							y: {
								beginAtZero: true,
								ticks: {
									precision: 0,
									color: '#9ca3af'
								},
								grid: {
									display: false
								}
							},
							x: {
								ticks: {
									color: '#9ca3af'
								},
								grid: {
									display: false
								}
							}
						},
						plugins: {
							legend: {
								display: false
							},
							tooltip: {
								backgroundColor: '#0f172a',
								titleColor: '#e2e8f0',
								bodyColor: '#e2e8f0',
								borderColor: 'rgba(255, 255, 255, 0.1)',
								borderWidth: 1,
								padding: 10,
								displayColors: false,
								callbacks: {
									title: function(context) {
										return months[context[0].dataIndex] + ' ' + currentYear;
									},
									label: function(context) {
										const value = context.parsed.y;
										return value + (value === 1 ? ' booking' : ' bookings');
									}
								}
							}
						}
					}
				});
			}
			
			// Create Events Chart
			const eventsChartElement = document.getElementById('eventsChart');
			if (eventsChartElement) {
				new Chart(eventsChartElement, {
					type: 'doughnut',
					data: {
						labels: ['Upcoming', 'Past'],
						datasets: [{
							data: [{{ $upcoming_events->count() }}, {{ $past_events->count() }}],
							backgroundColor: [
								'rgba(99, 102, 241, 0.7)',
								'rgba(244, 63, 94, 0.7)'
							],
							borderColor: [
								'rgba(99, 102, 241, 1)',
								'rgba(244, 63, 94, 1)'
							],
							borderWidth: 1
						}]
					},
					options: {
						responsive: true,
						maintainAspectRatio: false,
						plugins: {
							legend: {
								position: 'bottom',
								labels: {
									color: '#9ca3af',
									font: {
										size: 11
									},
									padding: 10
								}
							},
							tooltip: {
								backgroundColor: '#0f172a',
								titleColor: '#e2e8f0',
								bodyColor: '#e2e8f0',
								borderColor: 'rgba(255, 255, 255, 0.1)',
								borderWidth: 1,
								padding: 10
							}
						}
					}
				});
			}
		});
	</script>
</body>
</html>

