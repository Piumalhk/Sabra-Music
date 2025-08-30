<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// Welcome view route
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashbosard', function () {
    return view('dashboard');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/booking', function () {
    return view('booking');
});

Route::get('/history', function () {
    return view('history');
});

Route::get('/schedule', function () {
    return view('schedule');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/admin', function () {
    return view('admin');
});



