@extends('layouts.app')

@section('section')
    <div class="min-h-screen bg-gray-50">

        @include('landing.auth-navbar')

        <div class="flex items-center justify-center px-4 py-24">
            <div class="w-full max-w-md">

                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-slate-900 tracking-tight">
                        Welcome back
                    </h1>
                    <p class="text-slate-900 mt-2 text-sm">
                        Sign in to your InternHub account
                    </p>
                </div>

                <x-auth-card>
                    <form action="{{ route('login') }}" method="POST" class="space-y-4">
                        @csrf

                        <x-input name="email" label="Email" type="email" required autocomplete="email"
                            placeholder="Enter your email" />

                        <x-input name="password" label="Password" type="password" required autocomplete="current-password"
                            placeholder="Enter your password" />

                        <x-submit-button type="submit" color="bg-blue-600 hover:bg-blue-600" > Login </x-submit-button>
                    </form>
                </x-auth-card>

            </div>
        </div>
    </div>
@endsection