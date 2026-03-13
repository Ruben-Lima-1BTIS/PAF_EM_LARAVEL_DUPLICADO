<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;




Route::middleware(['guest'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/cenas', [HomeController::class, 'cenas'])->name('home.cenas');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});



// Route::middleware(['auth', 'role:admin'])->group(function () {
Route::middleware(['auth'])->group(function () {

    Route::get('/hr', [HRController::class, 'index'])->name('hr.index');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // create shit
    Route::post('/hr/company', [HRController::class, 'createCompany'])->name('hr.company.create');
    Route::post('/hr/class', [HRController::class, 'createClass'])->name('hr.class.create');
    Route::post('/hr/internship', [HRController::class, 'createInternship'])->name('hr.internship.create');
    Route::post('/hr/createUser', [HRController::class, 'createUser'])->name('hr.user.create');

    // assing shit
    Route::post('/hr/assignUser', [HRController::class, 'assignUserInternship'])->name('hr.user.assignUser');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});
