<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoghourController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HourApprovalController;

// ---------- PUBLIC GUEST ----------
Route::middleware(['guest'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home.index'); // landing page
    Route::get('/cenas', [HomeController::class, 'cenas'])->name('home.cenas');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

// ---------- LOGOUT ----------
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// ---------- AUTHENTICATED ----------
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

    // ---------- ADMIN ----------
    Route::middleware('role:admin')->group(function () {
        Route::get('/hr', [HRController::class, 'index'])->name('hr.index');

        Route::post('/hr/company', [HRController::class, 'createCompany'])->name('hr.company.create');
        Route::post('/hr/class', [HRController::class, 'createClass'])->name('hr.class.create');
        Route::post('/hr/internship', [HRController::class, 'createInternship'])->name('hr.internship.create');
        Route::post('/hr/createUser', [HRController::class, 'createUser'])->name('hr.user.create');

        Route::post('/hr/assignUser', [HRController::class, 'assignUserInternship'])->name('hr.user.assignUser');
    });

    // ---------- STUDENT ----------
    Route::middleware('role:student')->group(function () {
        // Hours
        Route::get('/myhours', [LoghourController::class, 'index'])->name('student.hours');
        Route::post('/loghours', [LoghourController::class, 'store'])->name('log.hours');
        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('student.reports');
        Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    });

    /*
        ---------- COORDINATOR ----------
        Route::middleware('role:coordinator')->group(function () {
            // rotas para coordenadores ainda nao criadas
        });
    */

    //  ---------- SUPERVISOR ----------
    Route::middleware('role:supervisor')->group(function () {
        Route::get('/hour-approval', [HourApprovalController::class, 'index'])->name('supervisor.hour_approval');
        Route::post('/hour-approval/{id}/approve', [HourApprovalController::class, 'approve'])->name('hour.approve');
        Route::post('/hour-approval/{id}/reject', [HourApprovalController::class, 'reject'])->name('hour.reject');
    });
});
