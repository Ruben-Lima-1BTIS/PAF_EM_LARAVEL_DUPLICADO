@extends('layouts.app')

@section('section')
<div class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white border border-gray-200 rounded-xl p-8 w-full max-w-md shadow-sm">

        <div class="mb-6 text-center">
            <div class="mx-auto mb-4 h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                <x-fas-ban class="h-6 w-6 text-slate-700" />
            </div>

            <h2 class="text-xl font-semibold">Method Not Allowed</h2>
            <p class="text-slate-700 text-sm mt-1">
                You can't access this page directly. Please use the app as intended.
            </p>
        </div>

        <a href="{{ url('/') }}">
            <x-submit-button color="bg-blue-600 hover:bg-blue-600">
                Go back home
            </x-submit-button>
        </a>

        <p class="text-xs text-slate-700 text-center mt-6">
            <span>Error 405 — Method Not Allowed</span>
        </p>

    </div>
</div>
@endsection