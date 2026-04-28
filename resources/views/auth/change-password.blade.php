@extends('layouts.app')

@section('section')
<div class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white border border-gray-200 rounded-xl p-8 w-full max-w-md shadow-sm">

        <div class="mb-6 text-center">
            <div class="mx-auto mb-4 h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                <x-fas-lock class="h-6 w-6 text-slate-700" />
            </div>

            <h2 class="text-xl font-semibold">Change your password</h2>
            <p class="text-slate-700 text-sm mt-1">
                For security reasons, you must update your password before continuing.
            </p>
        </div>

        <form action="{{ route('password.change.post') }}" method="POST" class="space-y-4">
            @csrf

            <div class="relative">
                <x-input
                    name="password"
                    type="password"
                    label="New password"
                    required="true"
                    placeholder="Enter a new password"
                />
            </div>

            <div class="relative">
                <x-input
                    name="password_confirmation"
                    type="password"
                    label="Confirm password"
                    required="true"
                    placeholder="Re-enter your password"
                />
            </div>

            <div class="pt-2">
                <x-submit-button type="submit" color="bg-blue-600 hover:bg-blue-600">
                    Change Password
                </x-submit-button>
            </div>
        </form>

        <p class="text-xs text-slate-700 text-center mt-6">
            <span>Your new password must be at least 8 characters long.</span>
        </p>
    </div>
</div>
@endsection
