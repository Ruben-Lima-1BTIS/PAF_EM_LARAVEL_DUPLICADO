@extends('layouts.app')

@section('section')

<div class="bg-gray-50 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white border border-gray-200 rounded-xl p-8 w-full max-w-md shadow-sm text-center">

        <div class="mx-auto mb-4 h-12 w-12 rounded-full bg-neutral-100 flex items-center justify-center">
            <x-fas-question class="h-6 w-6 text-slate-700" />
        </div>

        <h2 class="text-xl font-semibold">Page Not Found</h2>
        <p class="text-gray-500 text-sm mt-1">
            The page you are looking for doesn't exist or has been moved.
        </p>

        <a href="{{ url('/') }}">
            <x-submit-button color="bg-neutral-400 hover:bg-neutral-500">
                Go back home
            </x-submit-button>
        </a>

        <p class="text-xs text-gray-600 text-center mt-6">
            <span>Error 404 — Page Not Found</span>
        </p>

    </div>

</div>

@endsection 