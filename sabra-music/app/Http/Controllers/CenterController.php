<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CenterController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centers = Center::orderBy('name')->get();
        return view('admin.centers.index', compact('centers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.centers.create');
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
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $centerData = $request->except('image');
        $centerData['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('centers', 'public');
            $centerData['image'] = $path;
        }
        
        Center::create($centerData);
        
        return redirect()->route('admin.centers.index')->with('success', 'Center created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $center = Center::findOrFail($id);
        return view('admin.centers.show', compact('center'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $center = Center::findOrFail($id);
        return view('admin.centers.edit', compact('center'));
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
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);
        
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $center = Center::findOrFail($id);
        $centerData = $request->except('image');
        $centerData['is_active'] = $request->has('is_active');
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($center->image) {
                Storage::disk('public')->delete($center->image);
            }
            
            $path = $request->file('image')->store('centers', 'public');
            $centerData['image'] = $path;
        }
        
        $center->update($centerData);
        
        return redirect()->route('admin.centers.index')->with('success', 'Center updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $center = Center::findOrFail($id);
        
        // Delete image if exists
        if ($center->image) {
            Storage::disk('public')->delete($center->image);
        }
        
        // Check if center has bookings
        if ($center->bookings()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete center with existing bookings');
        }
        
        $center->delete();
        
        return redirect()->route('admin.centers.index')->with('success', 'Center deleted successfully');
    }
    
    /**
     * Toggle center status
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleStatus($id)
    {
        $center = Center::findOrFail($id);
        $center->is_active = !$center->is_active;
        $center->save();
        
        return redirect()->back()->with('success', 'Center status updated successfully');
    }
}
