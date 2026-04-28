@extends('layouts.app')

@section('section')

<div class="bg-blue-50 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white border border-gray-200 rounded-xl p-8 w-full max-w-md shadow-sm text-center">

        <div class="mx-auto mb-4 h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
            <x-fas-lock class="h-6 w-6 text-slate-700" />
        </div>

        <h2 class="text-xl font-semibold">Access Denied</h2>
        <p class="text-slate-700 text-sm mt-1 mb-4">
            You don't have permission to view this page.
        </p>

        <a href="{{ url('/') }}">
            <x-submit-button color="bg-blue-600 hover:bg-blue-600">
                Go back home
            </x-submit-button>
        </a>

        <p class="text-xs text-slate-700 text-center mt-6">
            <span>Error 403 — Access Denied</span>
        </p>

    </div>

</div>

@endsection