<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function index()
    {
        // Get stats for dashboard
        $stats = [
            'bookings' => Booking::count(),
            'events' => Event::count(),
            'users' => User::where('role', 'user')->count(),
        ];
        
        // Get recent activities
        $recent_activities = collect();
        
        // Recent bookings
        $recent_bookings = Booking::with(['user', 'center'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($booking) use ($recent_activities) {
                $recent_activities->push([
                    'time' => $booking->created_at,
                    'activity' => "New booking for {$booking->center->name}",
                    'user' => $booking->user->email,
                    'type' => 'booking',
                    'id' => $booking->id
                ]);
                return $booking;
            });
            
        // Recent events
        $recent_events = Event::orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($event) use ($recent_activities) {
                $recent_activities->push([
                    'time' => $event->created_at,
                    'activity' => "Event \"{$event->title}\" {$event->status}",
                    'user' => 'admin@example.com', // Placeholder, would be event->user->email in full implementation
                    'type' => 'event',
                    'id' => $event->id
                ]);
                return $event;
            });
            
        // Recent users
        $recent_users = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function($user) use ($recent_activities) {
                $recent_activities->push([
                    'time' => $user->created_at,
                    'activity' => "User \"{$user->name}\" registered",
                    'user' => $user->email,
                    'type' => 'user',
                    'id' => $user->id
                ]);
                return $user;
            });
            
        // Sort activities by time
        $recent_activities = $recent_activities->sortByDesc('time')->take(10);
        
        // Get bookings for bookings tab
        $bookings = Booking::with(['user', 'center'])
            ->orderBy('booking_date', 'desc')
            ->get();
            
        $pending_bookings = $bookings->where('status', 'pending');
        $approved_bookings = $bookings->where('status', 'approved');
        $rejected_bookings = $bookings->where('status', 'rejected');
        
        // Get events for events tab
        $events = Event::orderBy('event_date', 'desc')->get();
        $upcoming_events = $events->where('event_date', '>=', now()->format('Y-m-d'));
        $past_events = $events->where('event_date', '<', now()->format('Y-m-d'));
        
        // Get users for users tab
        $users = User::orderBy('created_at', 'desc')->get();
        
        return view('admin', compact(
            'stats', 
            'recent_activities', 
            'bookings', 
            'pending_bookings', 
            'approved_bookings', 
            'rejected_bookings',
            'events',
            'upcoming_events',
            'past_events',
            'users'
        ));
    }
    
    public function dashboard()
    {
        return $this->index();
    }
    
    public function bookings()
    {
        $bookings = Booking::with(['user', 'center'])->orderBy('booking_date', 'desc')->get();
        return view('admin.bookings.index', compact('bookings'));
    }
    
    public function showBooking(Booking $booking)
    {
        $booking->load(['user', 'center']);
        return view('admin.bookings.show', compact('booking'));
    }
    
    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);
        
        $booking->status = $validated['status'];
        $booking->save();
        
        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }
}
