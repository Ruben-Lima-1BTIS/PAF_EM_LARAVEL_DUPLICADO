@extends('layouts.app')
@section('section')


<div class="landing-page">
    <nav class="navbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="logo-box">IH</div>
                <span class="text-xl font-bold text-slate-900">InternHub</span>
            </div>
            <a href="{{route('auth.showLogin')}}" class="btn-primary">
                Login
            </a>
        </div>
    </nav>
    <div class="max-w-6xl mx-auto px-6 py-24 text-center">
        <h1 class="hero-title">
            Track Your Internship the Smart Way
        </h1>
        <p class="hero-subtext">
            Log hours, submit reports, and monitor progress in one clean, modern platform built for students, supervisors, and coordinators.
        </p>
        <div class="mt-10">
            <a href="{{route('auth.showLogin')}}" class="btn-primary">
                Get Started
            </a>
        </div>
    </div>
    <div class="max-w-6xl mx-auto px-6 pb-24">
        <div class="text-center mb-16">
            <h2 class="section-title">Built for Every Role</h2>
            <p class="section-subtext">
                Everything needed to manage internships efficiently.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card">
                <div class="icon-wrap">
                    <x-fas-user-graduate class="w-6 h-6" />
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Students</h3>
                <ul class="space-y-2 text-slate-600 text-sm">
                    <li>Log internship hours</li>
                    <li>Submit weekly reports</li>
                    <li>Track progress in real time</li>
                    <li>Chat with supervisors</li>
                </ul>
            </div>
            <div class="card">
                <div class="icon-wrap">
                    <x-fas-user-tie class="w-6 h-6" />
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Supervisors</h3>
                <ul class="space-y-2 text-slate-600 text-sm">
                    <li>Approve hours & reports</li>
                    <li>Provide structured feedback</li>
                    <li>Manage multiple interns</li>
                    <li>Export performance data</li>
                </ul>
            </div>
            <div class="card">
                <div class="icon-wrap">
                    <x-fas-chalkboard-teacher class="w-6 h-6" />
                </div>
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Coordinators</h3>
                <ul class="space-y-2 text-slate-600 text-sm">
                    <li>Monitor all student progress</li>
                    <li>Identify students needing support</li>
                    <li>View analytics & statistics</li>
                    <li>Ensure requirements are met</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection