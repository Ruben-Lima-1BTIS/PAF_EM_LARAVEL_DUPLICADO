<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HourApprovalController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('supervisor.hours_approval.index', ['user' => $user]);
    }
}
