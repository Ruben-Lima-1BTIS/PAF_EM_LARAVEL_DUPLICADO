@extends('layouts.app')
@section('section')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');

    .landing-page * {
        font-family: 'Sora', sans-serif;
    }

    .landing-page {
        background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #f1f5f9 100%);
        min-height: 100vh;
    }

    .navbar {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
    }

    .logo-box {
        background: linear-gradient(135deg, #0d9488, #0f766e);
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 0.35rem 0.75rem;
        border-radius: 0.6rem;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.04em;
    }

    .hero-subtext {
        font-size: 1.15rem;
        color: #64748b;
        max-width: 640px;
        margin: 1.5rem auto 0;
    }

    .btn-primary {
        background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
        color: white;
        padding: 0.85rem 1.75rem;
        border-radius: 0.75rem;
        font-weight: 600;
        font-size: 1rem;
        box-shadow: 0 4px 14px rgba(13,148,136,0.3);
        transition: 0.2s ease;
        display: inline-block;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13,148,136,0.38);
    }

    .card {
        background: #ffffff;
        border-radius: 1rem;
        border: 1px solid #e2e8f0;
        padding: 2rem;
        transition: 0.2s ease;
    }

    .card:hover {
        box-shadow: 0 6px 20px rgba(15,23,42,0.08);
        transform: translateY(-4px);
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.03em;
    }

    .section-subtext {
        font-size: 1rem;
        color: #64748b;
        margin-top: 0.5rem;
    }

    .icon-wrap {
        width: 50px;
        height: 50px;
        border-radius: 0.8rem;
        background: linear-gradient(135deg, #f0fdfa, #ccfbf1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0d9488;
        margin-bottom: 1rem;
    }
</style>

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
                    <x-fas-user-graduate class="w-6 h-6"/>
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
                    <x-fas-user-tie class="w-6 h-6"/>
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
                    <x-fas-chalkboard-teacher class="w-6 h-6"/>
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