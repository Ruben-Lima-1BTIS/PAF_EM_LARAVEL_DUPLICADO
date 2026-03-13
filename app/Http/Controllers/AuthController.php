<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showlogin(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)){
            return back()->withErrors('Bued cenas erradas');
        }

        $request->session()->regenerate();

        $user = Auth::user();

        return redirect()->route('dashboard.index');
        /* return match ($user->role) {
            'admin' => redirect()->route('cenas_fixes.cenas'),
            'coordinator' => redirect()->route('cenas_fixes.cenas'),
            'supervisor' => redirect()->route('cenas_fixes.cenas'),
            'student' => redirect()->view('cenas_fixes.cenas'),
        }; */
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

