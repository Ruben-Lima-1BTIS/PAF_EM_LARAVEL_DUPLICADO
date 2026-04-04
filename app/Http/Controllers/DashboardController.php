<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Company;
use App\Models\ClassModel;
use App\Models\Internship;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'totalUsers' => User::count() - User::where('role', User::ROLE_ADMIN)->count(),
            'totalCoordinators' => User::where('role', User::ROLE_COORDINATOR)->count(),
            'totalSupervisors' => User::where('role', User::ROLE_SUPERVISOR)->count(),
            'totalStudents' => User::where('role', User::ROLE_STUDENT)->count(),
            'totalCompanies' => Company::count(),
            'totalClasses' => ClassModel::count(),
            'totalInternships' => Internship::count(),
        ];

        return view('dashboard.index', ['user' => $user], $stats);
    }
}
