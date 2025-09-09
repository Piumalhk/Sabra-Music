<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;

// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration
Route::get('/signup', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/signup', [RegisterController::class, 'register']);

Route::get('/adminlogin', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);

// Public routes
Route::get('/', function () {
    $upcoming_events = \App\Models\Event::where('status', 'published')
        ->where('event_date', '>=', now()->format('Y-m-d'))
        ->orderBy('event_date')
        ->get();
    return view('home', compact('upcoming_events'));
});

Route::get('/home', function () {
    return redirect('/');
});

Route::get('/schedule', function () {
    return view('schedule');
})->name('schedule');

// Past events history page - public route
Route::get('/history', [EventController::class, 'history'])->name('events.history');

// Fallback route for history
Route::get('/history-events', function() {
    try {
        $past_events = \App\Models\Event::where('status', 'published')
            ->where('event_date', '<', now()->format('Y-m-d'))
            ->orderBy('event_date', 'desc')
            ->get();
        
        return view('events.history-simple', ['past_events' => $past_events]);
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});

// Debug route to check all events
Route::get('/debug-events', function() {
    $all_events = \App\Models\Event::all();
    $published_events = \App\Models\Event::where('status', 'published')->get();
    $past_events = \App\Models\Event::where('status', 'published')
        ->where('event_date', '<', now()->format('Y-m-d'))
        ->get();
        
    return [
        'current_date' => now()->format('Y-m-d'),
        'total_events' => count($all_events),
        'all_events' => $all_events->map(function($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'date' => $event->event_date,
                'status' => $event->status,
            ];
        }),
        'published_count' => count($published_events),
        'past_count' => count($past_events),
    ];
});

// Booking Check/Availability
Route::get('/check', [BookingController::class, 'check'])->name('booking.check');
Route::post('/check/availability', [BookingController::class, 'checkAvailability'])->name('booking.checkAvailability');

// Protected routes (require login)
Route::middleware('auth')->group(function () {
    Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
    Route::get('/booking/success', function() {
        return view('booking-success');
    })->name('booking.success');
    Route::get('/booking/{booking}/edit', [BookingController::class, 'userEdit'])->name('booking.edit');
    Route::put('/booking/{booking}', [BookingController::class, 'userUpdate'])->name('booking.update');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Bookings management
    Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings.index');
    Route::get('/bookings/{booking}', [AdminController::class, 'showBooking'])->name('admin.bookings.show');
    Route::get('/bookings/{booking}/edit', [AdminController::class, 'editBooking'])->name('admin.bookings.edit');
    Route::put('/bookings/{booking}', [AdminController::class, 'updateBooking'])->name('admin.bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    Route::patch('/bookings/{booking}/status', [AdminController::class, 'updateBookingStatus'])->name('admin.bookings.status');
    Route::get('/bookings/{booking}/pdf', [BookingController::class, 'viewPdf'])->name('admin.bookings.pdf');
    
    // Events management
    Route::resource('events', EventController::class);
    Route::patch('/events/{event}/publish', [EventController::class, 'publish'])->name('events.publish');
    Route::patch('/events/{event}/draft', [EventController::class, 'draft'])->name('events.draft');
    
    // Users management
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    
    // Seed past events for testing
    Route::get('/seed-past-events', function() {
        return view('admin.seed-past-events');
    })->name('admin.seed-past-events-form');
    
    Route::post('/seed-past-events', function(\Illuminate\Http\Request $request) {
        $count = $request->input('count', 3);
        
        for ($i = 1; $i <= $count; $i++) {
            // Create a past date (between 1-365 days ago)
            $pastDate = \Carbon\Carbon::now()->subDays(rand(1, 365))->format('Y-m-d');
            
            // Create the event
            \App\Models\Event::create([
                'title' => 'Past Test Event ' . $i,
                'description' => 'This is a test past event created for testing the history page',
                'event_date' => $pastDate,
                'event_time' => '19:00:00',
                'location' => 'Test Location ' . $i,
                'status' => 'published',
            ]);
        }
        
        return redirect()->route('admin.seed-past-events-form')->with('success', $count . ' past events created successfully!');
    })->name('admin.seed-past-events');
});
