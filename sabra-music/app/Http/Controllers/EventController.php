<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['upcoming', 'past', 'history']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->get();
        $upcoming_events = $events->where('event_date', '>=', now()->format('Y-m-d'));
        $past_events = $events->where('event_date', '<', now()->format('Y-m-d'));
        
        return view('admin.events.index', compact('events', 'upcoming_events', 'past_events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB limit, common image formats
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $eventData = $request->except(['image', 'submit_type']);
        
        // Set status based on submit_type button clicked
        if ($request->input('submit_type') === 'publish') {
            $eventData['status'] = 'published';
        } else {
            $eventData['status'] = 'draft';
        }
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Ensure the file is valid
            if ($image->isValid()) {
                // Store with original filename to make it more identifiable
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('events', $filename, 'public');
                $eventData['image'] = $path;
            }
        }
        
        $event = Event::create($eventData);
        
        $message = $eventData['status'] === 'published' ? 'Event published successfully' : 'Event saved as draft successfully';
        return redirect()->route('events.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'event_time' => 'required',
            'location' => 'required|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'status' => 'required|in:draft,published',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $event = Event::findOrFail($id);
        $eventData = $request->except(['image', 'remove_image']);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            
            $image = $request->file('image');
            
            // Ensure the file is valid
            if ($image->isValid()) {
                // Store with original filename to make it more identifiable
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('events', $filename, 'public');
                $eventData['image'] = $path;
            }
        } 
        // Handle image removal
        else if ($request->has('remove_image')) {
            // Delete old image if exists
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $eventData['image'] = null;
        }
        
        $event->update($eventData);
        
        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        
        // Delete image if exists
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }
        
        $event->delete();
        
        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }
    
    /**
     * Publish an event
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publish($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'published';
        $event->save();
        
        return redirect()->back()->with('success', 'Event published successfully');
    }
    
    /**
     * Draft an event
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function draft($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'draft';
        $event->save();
        
        return redirect()->back()->with('success', 'Event saved as draft successfully');
    }
    
    /**
     * Show upcoming events on the public page
     *
     * @return \Illuminate\Http\Response
     */
    public function upcoming()
    {
        $events = Event::where('status', 'published')
            ->where('event_date', '>=', now()->format('Y-m-d'))
            ->orderBy('event_date')
            ->get();
            
        return view('events.upcoming', compact('events'));
    }
    
    /**
     * Show past events on the public page
     *
     * @return \Illuminate\Http\Response
     */
    public function past()
    {
        $events = Event::where('status', 'published')
            ->where('event_date', '<', now()->format('Y-m-d'))
            ->orderBy('event_date', 'desc')
            ->get();
            
        return view('events.past', compact('events'));
    }
    
    /**
     * Show past events history for users
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        try {
            // Debug info
            \Log::info('Fetching past events for history page');
            \Log::info('Current date: ' . now()->format('Y-m-d'));
            
            // Get ALL published events, we'll handle date filtering in the code
            $all_events = Event::where('status', 'published')->get();
            \Log::info('Total published events: ' . count($all_events));
            
            // Option 1: Events with past dates using database query
            $past_events_db = Event::where('status', 'published')
                ->where('event_date', '<', now()->format('Y-m-d'))
                ->orderBy('event_date', 'desc')
                ->get();
            
            \Log::info('Found ' . count($past_events_db) . ' past events using DB query');
            
            // Option 2: If the DB query returned no events, try a different approach
            // Get past events using Carbon comparison (might be more accurate)
            $past_events_carbon = $all_events->filter(function($event) {
                $event_date = \Carbon\Carbon::parse($event->event_date);
                $now = \Carbon\Carbon::now()->startOfDay();
                return $event_date->lt($now);
            })->sortByDesc('event_date');
            
            \Log::info('Found ' . count($past_events_carbon) . ' past events using Carbon comparison');
            
            // Choose whichever method found events
            $past_events = count($past_events_db) > 0 ? $past_events_db : $past_events_carbon;
            
            // If we still have no past events but have published events, show all published events
            if (count($past_events) === 0 && count($all_events) > 0) {
                \Log::info('Using all published events instead of just past events');
                $past_events = $all_events;
            }
            
            // Format dates
            $past_events->each(function($event) {
                $event->formattedDate = \Carbon\Carbon::parse($event->event_date)->format('M d');
            });
                
            return view('history', ['past_events' => $past_events]);
        } catch (\Exception $e) {
            \Log::error('Error in history method: ' . $e->getMessage());
            return view('history', ['past_events' => collect([])]);
        }
    }
}
