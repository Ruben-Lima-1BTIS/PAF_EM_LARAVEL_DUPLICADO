<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password),
            'first_login' => 0,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Password changed successfully.');
    }
}