<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
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
		.main{flex:1;padding:22px}
		header.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
		.topbar-left{display:flex;align-items:center;gap:14px}
		.search{display:flex;align-items:center;gap:8px;background:rgba(255,255,255,0.03);padding:8px;border-radius:10px}
		.search input{border:0;background:transparent;color:#fff;outline:none;width:260px}
		.actions{display:flex;gap:10px;align-items:center}
		.btn{background:transparent;border:1px solid rgba(255,255,255,0.06);padding:8px 12px;border-radius:10px;color:#e6eef6;cursor:pointer}
		.btn.primary{background:var(--accent);border:none;color:#07221a}
		.icon-btn{background:transparent;border:0;color:var(--muted);font-size:18px;cursor:pointer}

		/* Stats */
		.stats{display:flex;gap:14px;margin-bottom:18px}
		.card{flex:1;background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);border-radius:12px;padding:14px;border:1px solid rgba(255,255,255,0.03)}
		.card .label{color:var(--muted);font-size:13px}
		.card .value{font-size:20px;margin-top:6px}

		/* Layout */
		.grid{display:grid;grid-template-columns:1fr 380px;gap:20px}
		.panel{background:linear-gradient(180deg,rgba(255,255,255,0.02),transparent);border-radius:12px;padding:16px;border:1px solid rgba(255,255,255,0.03)}
		.panel h3{margin:0 0 10px}

		/* Tables */
		table{width:100%;border-collapse:collapse}
		th,td{padding:10px;text-align:left;border-bottom:1px solid rgba(255,255,255,0.03);font-size:14px}
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
		.file-label{display:flex;align-items:center;gap:8px;padding:10px;border-radius:8px;border:1px dashed rgba(255,255,255,0.04);cursor:pointer;color:var(--muted)}
		.img-preview{width:100%;height:140px;object-fit:cover;border-radius:8px;background:#031224;display:block}
		.select{padding:10px;border-radius:8px;border:1px solid rgba(255,255,255,0.03);background:transparent;color:#e6eef6}
		.help{font-size:12px;color:var(--muted);margin-top:6px}

		/* Responsive */
		@media (max-width:1000px){.sidebar{display:none}.grid{grid-template-columns:1fr}.form-row{flex-direction:column}}
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
					<a href="#centers" data-target="centers"><i class="fas fa-building"></i> Centers Management <i style="margin-left:auto" class="fas fa-chevron-down toggle"></i></a>
					<div class="submenu" data-parent="centers">
						<a href="#add-center">➕ Add Center</a>
						<a href="#view-centers">View/Edit Centers</a>
					</div>
				</div>

				<div class="section">
					<a href="#bookings" data-target="bookings"><i class="fas fa-calendar-check"></i> Bookings <i style="margin-left:auto" class="fas fa-chevron-down toggle"></i></a>
					<div class="submenu" data-parent="bookings">
						<a href="#all-bookings">All Bookings</a>
						<a href="#pending-approvals">Pending Approvals</a>
					</div>
				</div>

				<div class="section">
					<a href="#events" data-target="events"><i class="fas fa-calendar-day"></i> Events <i style="margin-left:auto" class="fas fa-chevron-down toggle"></i></a>
					<div class="submenu" data-parent="events">
						<a href="#add-event">➕ Add Event</a>
						<a href="#upcoming-events">Upcoming Events</a>
						<a href="#past-events">Past Events</a>
					</div>
				</div>

				<div class="section">
					<a href="#items" data-target="items"><i class="fas fa-boxes"></i> Items <i style="margin-left:auto" class="fas fa-chevron-down toggle"></i></a>
					<div class="submenu" data-parent="items">
						<a href="#add-item">➕ Add Item</a>
						<a href="#view-items">View Items</a>
						<a href="#reservations">Reservations</a>
					</div>
				</div>

				<div class="section">
					<a href="#users" data-target="users"><i class="fas fa-users"></i> Users <i style="margin-left:auto" class="fas fa-chevron-down toggle"></i></a>
					<div class="submenu" data-parent="users">
						<a href="#all-users">All Users</a>
						<a href="#roles">Roles & Permissions</a>
					</div>
				</div>

				<div class="section">
					<a href="#settings" data-target="settings"><i class="fas fa-cog"></i> Settings</a>
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
					<div class="search"><i class="fas fa-search" style="opacity:0.6"></i><input placeholder="Search events, users, centers..." /></div>
					<button class="icon-btn" title="Notifications"><i class="fas fa-bell"></i></button>
					<div style="display:flex;align-items:center;gap:10px">
						<div style="text-align:right;margin-right:6px">
							<div style="font-size:13px">Admin</div>
							<div style="color:var(--muted);font-size:12px">admin@example.com</div>
						</div>
						<button class="btn">Logout</button>
					</div>
				</div>
			</header>

			<!-- Stats -->
			<div class="stats">
				<div class="card">
					<div class="label">Total Centers 🏛️</div>
					<div class="value">12</div>
				</div>
				<div class="card">
					<div class="label">Total Bookings 📅</div>
					<div class="value">1,254</div>
				</div>
				<div class="card">
					<div class="label">Total Events 🎭</div>
					<div class="value">43</div>
				</div>
				<div class="card">
					<div class="label">Total Users 👥</div>
					<div class="value">3,287</div>
				</div>
			</div>

			<div class="grid">
				<section>
					<div class="panel" id="dashboard">
						<h3>Analytics</h3>
						<div style="display:flex;gap:12px;align-items:stretch;margin-top:12px">
							<div style="flex:1;padding:12px;border-radius:8px;background:rgba(255,255,255,0.02);min-height:160px">
								<div style="color:var(--muted);font-size:13px">Bookings per month</div>
								<div style="height:110px;background:linear-gradient(90deg,rgba(255,255,255,0.01),transparent);border-radius:6px;margin-top:8px;display:flex;align-items:center;justify-content:center;color:var(--muted)">[Chart placeholder]</div>
							</div>
							<div style="width:220px;padding:12px;border-radius:8px;background:rgba(255,255,255,0.02);min-height:160px">
								<div style="color:var(--muted);font-size:13px">Event participation</div>
								<div style="height:110px;background:linear-gradient(90deg,rgba(255,255,255,0.01),transparent);border-radius:6px;margin-top:8px;display:flex;align-items:center;justify-content:center;color:var(--muted)">[Chart]</div>
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
									<tr><td>10m ago</td><td>New booking for Center A</td><td>jane.doe@example.com</td><td style="text-align:right;color:var(--muted)">View</td></tr>
									<tr><td>2h ago</td><td>Event "Ridmya" published</td><td>admin@example.com</td><td style="text-align:right;color:var(--muted)">View</td></tr>
									<tr><td>1d ago</td><td>User "john" registered</td><td>john@example.com</td><td style="text-align:right;color:var(--muted)">View</td></tr>
								</tbody>
							</table>
						</div>
					</div>

					<div style="height:14px"></div>

					<div class="panel" id="centers">
						<h3>Centers Management</h3>
						<div style="display:flex;justify-content:space-between;align-items:center;margin-top:10px">
							<div style="color:var(--muted)">Manage centers — add, edit or remove centers</div>
							<button class="btn primary" onclick="openSection('add-center')">➕ Add Center</button>
						</div>
						<div style="margin-top:12px;overflow:auto">
							<table>
								<thead>
									<tr><th>Name</th><th>Location</th><th>Price</th><th>Status</th><th>Actions</th></tr>
								</thead>
								<tbody>
									<tr><td>Center A</td><td>Colombo</td><td>$50/hr</td><td>Active</td><td><button class="btn"><i class="fas fa-edit"></i></button> <button class="btn"><i class="fas fa-trash"></i></button></td></tr>
									<tr><td>Center B</td><td>Kandy</td><td>$40/hr</td><td>Inactive</td><td><button class="btn"><i class="fas fa-edit"></i></button> <button class="btn"><i class="fas fa-trash"></i></button></td></tr>
								</tbody>
							</table>
						</div>
					</div>

				</section>

				<aside>
					<div class="panel" id="quick-actions">
						<h3>Quick Actions</h3>
						<div style="display:flex;flex-direction:column;gap:8px;margin-top:10px">
							<button class="btn" onclick="openSection('bookings')">View Bookings</button>
							<button class="btn" onclick="openSection('events')">Create Event</button>
							<button class="btn" onclick="openSection('users')">Manage Users</button>
						</div>
					</div>

					<div style="height:12px"></div>

					<div class="panel" id="createEventPanel">
						<h3>Create Event</h3>
						<form id="createForm" style="margin-top:12px">
							<div class="form-row">
								<div class="form-col">
									<label class="label">Title</label>
									<input class="input" id="evt-title" type="text" placeholder="Event title">

									<label class="label" style="margin-top:8px">Date</label>
									<input class="input" id="evt-date" type="date">

									<label class="label" style="margin-top:8px">Time</label>
									<input class="input" id="evt-time" type="time">

									<label class="label" style="margin-top:8px">Location</label>
									<input class="input" id="evt-location" type="text" placeholder="Location">

									<label class="label" style="margin-top:8px">Price (optional)</label>
									<input class="input" id="evt-price" type="text" placeholder="$0.00">

									<label class="label" style="margin-top:8px">Status</label>
									<select id="evt-status" class="select">
										<option value="draft">Draft</option>
										<option value="published">Published</option>
									</select>
								</div>

								<div style="width:220px">
									<label class="label">Cover Image</label>
									<img id="imgPreview" class="img-preview" src="{{ asset('images/bg1.jpg') }}" alt="image preview">
									<label class="file-label" style="margin-top:8px">
										<i class="fas fa-upload"></i>
										<span id="fileLabelText">Upload image</span>
										<input id="imgInput" class="file-input" type="file" accept="image/*">
									</label>
									<div class="help">Recommended size: 1200x600px. JPG or PNG.</div>
								</div>
							</div>

							<label class="label" style="margin-top:10px">Description</label>
							<textarea id="evt-desc" class="input" style="min-height:120px" placeholder="Short description"></textarea>

							<div style="display:flex;gap:8px;margin-top:12px">
								<button type="button" id="publishBtn" class="btn primary">Publish</button>
								<button type="button" id="saveDraftBtn" class="btn">Save Draft</button>
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
							<thead><tr><th>User</th><th>Center</th><th>Date</th><th>Time</th><th>Status</th><th>Actions</th></tr></thead>
							<tbody>
								<tr><td>jane.doe@example.com</td><td>Center A</td><td>2025-09-02</td><td>18:00</td><td>Pending</td><td><button class="btn">View</button></td></tr>
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
						<button class="active" data-tab="upcoming">Upcoming</button>
						<button data-tab="past">Past</button>
					</div>
					<div style="margin-top:10px">
						<table>
							<thead><tr><th>Title</th><th>Date</th><th>Photo</th><th>Description</th><th>Actions</th></tr></thead>
							<tbody>
								<tr><td>Ridmya – 2026</td><td>2026-08-12</td><td><img src="{{ asset('images/bg1.jpg') }}" style="width:80px;height:40px;object-fit:cover;border-radius:6px"/></td><td>Music concert</td><td><button class="btn"><i class="fas fa-edit"></i></button> <button class="btn"><i class="fas fa-trash"></i></button></td></tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<!-- Items management -->
			<div style="margin-top:18px" id="items">
				<div class="panel">
					<h3>Items & Reservations</h3>
					<div style="margin-top:10px">
						<h4 style="margin:0 0 8px">Inventory</h4>
						<table>
							<thead><tr><th>Item</th><th>Quantity</th><th>Availability</th><th>Actions</th></tr></thead>
							<tbody>
								<tr><td>Microphone</td><td>10</td><td>Available</td><td><button class="btn">Reserve</button></td></tr>
							</tbody>
						</table>

						<div style="height:12px"></div>
						<h4 style="margin:0 0 8px">Reservations</h4>
						<table>
							<thead><tr><th>User</th><th>Item</th><th>Pickup</th><th>Return</th><th>Status</th></tr></thead>
							<tbody>
								<tr><td>john@example.com</td><td>Microphone</td><td>2025-09-01</td><td>2025-09-03</td><td>Approved</td></tr>
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
								<tr><td>Admin</td><td>admin@example.com</td><td>Admin</td><td>Active</td><td><button class="btn">Edit</button></td></tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</main>
	</div>

	<script>
		// Sidebar submenu toggle
		document.querySelectorAll('.nav .section > a').forEach(a => {
			a.addEventListener('click', (e) => {
				const target = a.getAttribute('data-target');
				if (!target) return; // some links are simple anchors
				const parentSub = document.querySelector('.submenu[data-parent="'+target+'"]');
				if (parentSub) {
					parentSub.style.display = parentSub.style.display === 'flex' ? 'none' : 'flex';
				}
			});
		});

		// Tabs
		document.querySelectorAll('.tabs').forEach(tabGroup => {
			tabGroup.querySelectorAll('button').forEach(btn => btn.addEventListener('click', () => {
				btn.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('active'));
				btn.classList.add('active');
				// content swapping could be implemented here
			}));
		});

		// Quick open
		function openSection(id){
			const el = document.getElementById(id);
			if (el){ el.scrollIntoView({behavior:'smooth', block:'start'}); el.style.transition='background 0.3s'; el.style.background='rgba(255,255,255,0.01)'; setTimeout(()=>el.style.background='transparent',700); }
		}


		// Small UI interactions for generic primary buttons
		document.querySelectorAll('.btn.primary').forEach(b => b.addEventListener('click', () => {
			b.disabled = true; const prev = b.innerText; b.innerText = 'Saving...'; setTimeout(() => { b.disabled = false; b.innerText = prev; }, 900);
		}));

		// Image preview for Create Event form
		const imgInput = document.getElementById('imgInput');
		const imgPreview = document.getElementById('imgPreview');
		const fileLabelText = document.getElementById('fileLabelText');
		if (imgInput) {
			imgInput.addEventListener('change', (e) => {
				const file = e.target.files && e.target.files[0];
				if (!file) return;
				fileLabelText.innerText = file.name;
				const reader = new FileReader();
				reader.onload = () => imgPreview.src = reader.result;
				reader.readAsDataURL(file);
			});
			// clicking label opens file chooser
			document.querySelectorAll('.file-label').forEach(lbl => lbl.addEventListener('click', () => imgInput.click()));
		}

		// Publish / Save draft UX (placeholder for real submit)
		const publishBtn = document.getElementById('publishBtn');
		const saveDraftBtn = document.getElementById('saveDraftBtn');
		if (publishBtn) publishBtn.addEventListener('click', () => handleSave('published'));
		if (saveDraftBtn) saveDraftBtn.addEventListener('click', () => handleSave('draft'));

		function handleSave(mode){
			const btn = mode === 'published' ? publishBtn : saveDraftBtn;
			btn.disabled = true; const prev = btn.innerText; btn.innerText = mode === 'published' ? 'Publishing...' : 'Saving...';
			// placeholder validation
			setTimeout(() => {
				btn.disabled = false; btn.innerText = prev; alert('Event '+(mode==='published'?'published':'saved as draft')+' (demo)');
			}, 800);
		}
	</script>
</body>
</html>

