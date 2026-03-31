@extends('layouts.app')

@section('section')
<body class="bg-gray-50 font-sans flex flex-col min-h-screen">


    <div class=" w-fit justify-center bg-blue-600 hover:bg-blue-700 text-white p-2 px-3 rounded-lg font-medium transition">
        <a href="{{ route('home.index') }}" class="flex items-center gap-2">
            <x-fas-arrow-left-long  class="w-6 h-6" /> Voltar
        </a>
    </div>

    <div class="flex-1 flex items-center justify-center py-16 px-4">
        <div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">

            <h2 class="text-3xl font-bold text-center text-gray-900 mb-6">
                Login
            </h2>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <x-input name="email" label="Email" type="email" required />
                <x-input name="password" label="Password" type="password" required />

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium transition">
                    Entrar
                </button>
            </form>

        </div>
    </div>
</body>
@endsection
 
{{-- 
@extends('layouts.app')

@section('section')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap');

    .login-page * { font-family: 'Sora', sans-serif; box-sizing: border-box; }

    /* ── Page shell ── */
    .login-page {
        min-height: 100vh;
        background: #eff6ff;
        display: flex;
        flex-direction: column;
    }

    /* ── Navbar (identical to landing) ── */
    .navbar { background: #ffffff; border-bottom: 1px solid #e5e7eb; }
    .logo-box {
        background: #2563eb; color: white; font-weight: 700;
        font-size: 1.1rem; padding: 0.35rem 0.75rem;
        border-radius: 0.6rem;
    }

    /* ── Back button ── */
    .btn-back {
        display: inline-flex; align-items: center; gap: 0.45rem;
        color: #2563eb; font-weight: 600; font-size: 0.85rem;
        border: 1.5px solid #bfdbfe; background: #eff6ff;
        padding: 0.45rem 1rem; border-radius: 0.6rem;
        transition: 0.2s ease; text-decoration: none;
    }
    .btn-back:hover {
        background: #dbeafe; border-color: #93c5fd;
        transform: translateX(-2px);
    }

    /* ── Split layout ── */
    .login-body {
        flex: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: calc(100vh - 65px);
    }

    /* ── Left panel ── */
    .login-left {
        background: #1e40af;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 4rem 3.5rem;
        position: relative;
        overflow: hidden;
    }

    /* Geometric decoration */
    .login-left::before {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 340px; height: 340px;
        border-radius: 50%;
        background: rgba(255,255,255,0.06);
        pointer-events: none;
    }
    .login-left::after {
        content: '';
        position: absolute;
        bottom: -60px; left: -60px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        pointer-events: none;
    }
    .geo-ring {
        position: absolute;
        bottom: 120px; right: -40px;
        width: 180px; height: 180px;
        border-radius: 50%;
        border: 2px solid rgba(255,255,255,0.08);
        pointer-events: none;
    }

    .left-eyebrow {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        color: #bfdbfe; font-size: 0.75rem; font-weight: 600;
        letter-spacing: 0.08em; text-transform: uppercase;
        padding: 0.3rem 0.85rem; border-radius: 999px;
        margin-bottom: 1.75rem; width: fit-content;
    }

    .left-title {
        font-size: 2.4rem; font-weight: 700;
        color: #ffffff; letter-spacing: -0.04em;
        line-height: 1.2;
        margin-bottom: 1.25rem;
    }
    .left-title span { color: #93c5fd; }

    .left-desc {
        color: #93c5fd; font-size: 0.95rem;
        line-height: 1.7; margin-bottom: 2.5rem;
    }

    /* Feature pills */
    .feature-list {
        display: flex; flex-direction: column; gap: 0.75rem;
    }
    .feature-item {
        display: flex; align-items: center; gap: 0.75rem;
        color: #dbeafe; font-size: 0.875rem;
    }
    .feature-dot {
        width: 28px; height: 28px; flex-shrink: 0;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 0.5rem;
        display: flex; align-items: center; justify-content: center;
        color: #93c5fd;
    }

    /* ── Right panel ── */
    .login-right {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 3rem 2.5rem;
        background: #eff6ff;
    }

    .login-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 1.25rem;
        padding: 2.75rem 2.5rem;
        width: 100%; max-width: 420px;
        box-shadow: 0 4px 24px rgba(30,64,175,0.08);
    }

    .card-header { margin-bottom: 2rem; }
    .card-tag {
        display: inline-block;
        background: #dbeafe; color: #1d4ed8;
        font-size: 0.7rem; font-weight: 700;
        letter-spacing: 0.1em; text-transform: uppercase;
        padding: 0.25rem 0.6rem; border-radius: 999px;
        margin-bottom: 0.75rem;
    }
    .card-title {
        font-size: 1.65rem; font-weight: 700;
        color: #0f172a; letter-spacing: -0.03em;
        margin-bottom: 0.35rem;
    }
    .card-sub { font-size: 0.875rem; color: #64748b; }

    /* ── Submit button ── */
    .btn-submit {
        width: 100%; padding: 0.85rem;
        background: #2563eb; color: #ffffff;
        border: none; border-radius: 0.75rem;
        font-family: 'Sora', sans-serif;
        font-size: 0.9rem; font-weight: 600;
        cursor: pointer; margin-top: 0.5rem;
        box-shadow: 0 4px 14px rgba(37,99,235,0.35);
        transition: 0.2s ease;
        display: flex; align-items: center;
        justify-content: center; gap: 0.5rem;
    }
    .btn-submit:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37,99,235,0.45);
    }
    .btn-submit:active { transform: translateY(0); }

    /* Divider */
    .divider {
        display: flex; align-items: center; gap: 0.75rem;
        margin: 1.5rem 0; color: #94a3b8; font-size: 0.75rem;
    }
    .divider::before, .divider::after {
        content: ''; flex: 1; height: 1px; background: #e5e7eb;
    }

    /* ── Responsive ── */
    @media (max-width: 768px) {
        .login-body { grid-template-columns: 1fr; }
        .login-left { display: none; }
        .login-right { padding: 2rem 1.25rem; }
    }


</style>

<div class="login-page">

    <nav class="navbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="logo-box">IH</div>
                <span class="text-xl font-bold text-slate-900" style="font-family:'Sora',sans-serif;">InternHub</span>
            </div>
            <a href="{{ route('home.index') }}" class="btn-back">
                <x-fas-arrow-left-long class="w-4 h-4" />
                Back to Home
            </a>
        </div>
    </nav>

    <div class="login-body">

        <div class="login-left">
            <div class="geo-ring"></div>

            <span class="left-eyebrow">
                ✦ Welcome back
            </span>

            <h2 class="left-title">
                Your internship,<br>
                <span>fully in control.</span>
            </h2>

            <p class="left-desc">
                Log in to access your dashboard — whether you're a student tracking hours,
                a supervisor reviewing reports, or a coordinator overseeing it all.
            </p>

            <div class="feature-list">
                <div class="feature-item">
                    <div class="feature-dot">
                        <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16A8 8 0 0010 2zm3.707 6.293a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                    </div>
                    Real-time hour tracking & progress
                </div>
                <div class="feature-item">
                    <div class="feature-dot">
                        <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16A8 8 0 0010 2zm3.707 6.293a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                    </div>
                    Approve reports & provide feedback
                </div>
                <div class="feature-item">
                    <div class="feature-dot">
                        <svg width="13" height="13" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16A8 8 0 0010 2zm3.707 6.293a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                        </svg>
                    </div>
                    Analytics & compliance monitoring
                </div>
            </div>
        </div>

        <div class="login-right">
            <div class="login-card">

                <div class="card-header">
                    <span class="card-tag">Secure Login</span>
                    <h2 class="card-title">Sign in to InternHub</h2>
                    <p class="card-sub">Enter your credentials to continue.</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <x-input name="email" label="Email address" type="email" required />
                    <x-input name="password" label="Password" type="password" required />

                    <button type="submit" class="btn-submit">
                        Sign In
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </form>

            </div>

            <p style="margin-top:1.5rem;font-size:0.78rem;color:#94a3b8;font-family:'Sora',sans-serif;">
                © {{ date('Y') }} InternHub · All rights reserved.
            </p>
        </div>

    </div>
</div>

@endsection
--}}