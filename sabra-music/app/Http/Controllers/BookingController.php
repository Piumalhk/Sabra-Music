<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Admin view of all bookings
        $this->middleware('admin');
        
        $bookings = Booking::with(['center', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show booking form for users
        $centers = Center::where('is_active', true)->get();
        return view('booking', compact('centers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'center_id' => 'required|exists:centers,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'nullable|after:start_time',
            'purpose' => 'required|string|max:255',
            'pdf_attachment' => 'nullable|file|mimes:pdf|max:10240',
        ]);
        
        // Check for conflicts
        $conflict = Booking::where('center_id', $request->center_id)
            ->where('booking_date', $request->booking_date)
            ->where(function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                      ->where('end_time', '>=', $request->start_time);
                })->orWhere(function($q) use ($request) {
                    $q->where('start_time', '<=', $request->end_time)
                      ->where('end_time', '>=', $request->end_time);
                });
            })
            ->whereIn('status', ['approved', 'pending'])
            ->exists();
            
        if ($conflict) {
            return back()->with('error', 'This time slot conflicts with an existing booking');
        }
        
        // Handle file upload
        if ($request->hasFile('pdf_attachment')) {
            $path = $request->file('pdf_attachment')->store('bookings');
            $validated['pdf_attachment'] = $path;
        }
        
        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';
        
        Booking::create($validated);
        
        return redirect()->route('booking.success')->with('success', 'Booking submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::with(['center', 'user'])->findOrFail($id);
        
        // Check if admin or the booking owner
        if (Auth::user()->role !== 'admin' && Auth::id() !== $booking->user_id) {
            abort(403);
        }
        
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Only admin can edit bookings
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $centers = Center::where('is_active', true)->get();
        return view('admin.bookings.edit', compact('booking', 'centers'));
    }
    
    /**
     * Show the form for editing the user's booking.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userEdit($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Only booking owner can edit
        if (Auth::id() !== $booking->user_id) {
            abort(403);
        }
        
        // Only allow editing of pending bookings
        if ($booking->status !== 'pending') {
            return redirect()->route('booking.check')->with('error', 'Only pending bookings can be edited');
        }
        
        $centers = Center::where('is_active', true)->get();
        return view('booking-edit', compact('booking', 'centers'));
    }

    /**
     * Update the specified resource in storage (admin only).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Only admin can update bookings
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $booking = Booking::findOrFail($id);
        
        $validated = $request->validate([
            'center_id' => 'required|exists:centers,id',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable|after:start_time',
            'purpose' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,rejected',
            'pdf_attachment' => 'nullable|file|mimes:pdf|max:10240',
        ]);
        
        // Handle file upload if a new file is provided
        if ($request->hasFile('pdf_attachment')) {
            // Delete old file if exists
            if ($booking->pdf_attachment) {
                Storage::delete($booking->pdf_attachment);
            }
            
            $path = $request->file('pdf_attachment')->store('bookings');
            $validated['pdf_attachment'] = $path;
        }
        
        $booking->update($validated);
        
        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully');
    }
    
    /**
     * Update the user's booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userUpdate(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Only booking owner can update their booking
        if (Auth::id() !== $booking->user_id) {
            abort(403);
        }
        
        // Only allow editing of pending bookings
        if ($booking->status !== 'pending') {
            return redirect()->route('booking.check')->with('error', 'Only pending bookings can be edited');
        }
        
        $validated = $request->validate([
            'center_id' => 'required|exists:centers,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'purpose' => 'required|string|max:255',
            'pdf_attachment' => 'nullable|file|mimes:pdf|max:10240',
        ]);
        
        // Check for conflicts with other bookings
        $conflict = Booking::where('center_id', $request->center_id)
            ->where('booking_date', $request->booking_date)
            ->where('id', '!=', $id) // Exclude the current booking
            ->where(function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                      ->where('end_time', '>=', $request->start_time);
                })->orWhere(function($q) use ($request) {
                    $q->where('start_time', '<=', $request->end_time)
                      ->where('end_time', '>=', $request->end_time);
                });
            })
            ->whereIn('status', ['approved', 'pending'])
            ->exists();
            
        if ($conflict) {
            return back()->with('error', 'This time slot conflicts with an existing booking');
        }
        
        // Handle file upload if a new file is provided
        if ($request->hasFile('pdf_attachment')) {
            // Delete old file if exists
            if ($booking->pdf_attachment) {
                Storage::delete($booking->pdf_attachment);
            }
            
            $path = $request->file('pdf_attachment')->store('bookings');
            $validated['pdf_attachment'] = $path;
        }
        
        $booking->update($validated);
        
        return redirect()->route('booking.check')->with('success', 'Booking updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Only admin can delete bookings
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $booking = Booking::findOrFail($id);
        
        // Delete the file if exists
        if ($booking->pdf_attachment) {
            Storage::delete($booking->pdf_attachment);
        }
        
        $booking->delete();
        
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully');
    }
    
    /**
     * Display user's booking history
     */
    public function history()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with('center')
            ->orderBy('booking_date', 'desc')
            ->get();
            
        return view('history', compact('bookings'));
    }
    
    /**
     * Display booking check page
     */
    public function check()
    {
        $centers = Center::where('is_active', true)->get();
        
        // If user is logged in, show only their bookings
        if (Auth::check()) {
            $recentBookings = Booking::with(['user', 'center'])
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        } else {
            // For non-logged in users, just show empty collection
            $recentBookings = collect();
        }
            
        return view('check', compact('centers', 'recentBookings'));
    }
    
    /**
     * Check booking availability
     */
    public function checkAvailability(Request $request)
    {
        $request->validate([
            'center_id' => 'required|exists:centers,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'exclude_booking_id' => 'nullable|integer', // Added to exclude current booking when editing
        ]);
        
        // Check for conflicts with existing bookings (more complex time overlap check)
        $query = Booking::where('center_id', $request->center_id)
            ->where('booking_date', $request->date)
            ->whereIn('status', ['approved', 'pending']);
            
        // Exclude the current booking if editing
        if ($request->has('exclude_booking_id')) {
            $query->where('id', '!=', $request->exclude_booking_id);
        }
        
        $conflict = $query->where(function($query) use ($request) {
                // Scenario 1: New booking starts during an existing booking
                $query->where(function($q) use ($request) {
                    $q->where('start_time', '<=', $request->start_time)
                      ->where('end_time', '>=', $request->start_time);
                })
                // Scenario 2: New booking ends during an existing booking
                ->orWhere(function($q) use ($request) {
                    $q->where('start_time', '<=', $request->end_time)
                      ->where('end_time', '>=', $request->end_time);
                })
                // Scenario 3: New booking completely contains an existing booking
                ->orWhere(function($q) use ($request) {
                    $q->where('start_time', '>=', $request->start_time)
                      ->where('end_time', '<=', $request->end_time);
                });
            })
            ->exists();
            
        return response()->json([
            'available' => !$conflict,
            'message' => $conflict ? 'This slot is already booked or pending approval' : 'Slot is available',
        ]);
    }
    
    /**
     * Update booking status (admin only)
     */
    public function updateStatus(Request $request, $id)
    {
        // Only admin can update status
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);
        
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();
        
        return redirect()->back()->with('success', 'Booking status updated successfully');
    }
    
    /**
     * View or download the PDF attachment
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewPdf($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Only admin or the booking owner can view the PDF
        if (Auth::user()->role !== 'admin' && Auth::id() !== $booking->user_id) {
            abort(403);
        }
        
        if (!$booking->pdf_attachment) {
            return redirect()->back()->with('error', 'No PDF attachment found for this booking.');
        }
        
        // Return the file as a response with proper content type
        return Storage::response($booking->pdf_attachment);
    }
}
