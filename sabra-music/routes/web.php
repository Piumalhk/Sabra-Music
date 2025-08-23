<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// Welcome view route
Route::get('/', function () {
    return view('welcome');
});

// Login view route
Route::view('/login', 'login')->name('login');

// Handle login form submission
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $remember = $request->filled('remember');

    if (Auth::attempt($credentials, $remember)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('login.attempt');

Route::get('/dashboard', function () {
    
    echo 'dashboard';
});

// Home view route
Route::view('/home', 'home')->name('home');


