<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'index_no' => 'required',
            'password' => 'required',
        ]);
        
        if (Auth::attempt(['index_no' => $credentials['index_no'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/schedule');
        }
        
        return back()->withErrors([
            'index_no' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('index_no'));
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
