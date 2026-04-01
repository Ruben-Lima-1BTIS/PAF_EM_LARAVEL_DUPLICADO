@extends('layouts.app')
@section('section')

<div class="landing-page">

    <nav class="navbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="logo-box">IH</div>
                <span class="text-xl font-bold text-slate-900">InternHub</span>
            </div>
            <a href="{{ route('home.index') }}" class="back-link">
                <x-fas-arrow-left-long class="w-4 h-4" />
                Back to Home
            </a>
        </div>
    </nav>

    <div class="flex items-center justify-center px-4 py-24">
        <div class="w-full max-w-md">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Welcome back</h1>
                <p class="text-slate-500 mt-2 text-sm">Sign in to your InternHub account</p>
            </div>

            <div class="card">
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf

                    <x-input name="email" label="Email" type="email" required />
                    <x-input name="password" label="Password" type="password" required />

                    <button class="btn-submit">
                        Entrar
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>

@endsection
 