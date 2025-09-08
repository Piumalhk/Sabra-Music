<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('signup');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'index_no' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Create the user
        $user = User::create([
            'name' => $request->name ?? explode('@', $request->email)[0], // Use part of email if name not provided
            'email' => $request->email,
            'index_no' => $request->index_no,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to schedule page
        return redirect()->route('schedule')->with('success', 'Registration successful! Welcome to Sabra Music.');
    }
}
