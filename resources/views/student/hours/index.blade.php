@extends('layouts.auth')

@section('content')

<div class="max-w-6xl mx-auto p-6 space-y-8">

    {{-- TITLE --}}
    <div>
        <h2 class="text-2xl font-semibold text-gray-800">Log Hours</h2>
        <p class="text-gray-500 text-sm">Track and manage your internship time</p>
    </div>

    {{-- GRID --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- FORM --}}
        <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-md border">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Add Hours</h3>

            <form action="{{ route('log.hours') }}" method="POST" class="space-y-4">
                @csrf

                <x-input name="date" type="date" label="Date" required />

                <div class="grid grid-cols-2 gap-3">
                    <x-input name="start_time" type="time" label="Start" required />
                    <x-input name="end_time" type="time" label="End" required />
                </div>

                <button 
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2.5 rounded-lg transition font-medium">
                    Log Hours
                </button>
            </form>
        </div>

        {{-- STATS (subtle) --}}
        <div class="lg:col-span-2 bg-white p-4 rounded-xl shadow-md border flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Hours</p>
                <p class="text-lg font-semibold text-gray-800">{{ $totalHours }}h</p>
            </div>
        </div>

    </div>

    {{-- TABLE --}}
    <div class="bg-white p-6 rounded-xl shadow-md border">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Entries</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="border-b text-gray-500 text-sm">
                    <tr>
                        <th class="text-left py-2">Date</th>
                        <th class="text-left py-2">Start</th>
                        <th class="text-left py-2">End</th>
                        <th class="text-left py-2">Hours</th>
                        <th class="text-left py-2">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach($logs as $log)
                        @php
                            $status = strtolower($log->status);
                            $badge = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'approved' => 'bg-green-100 text-green-700',
                                'rejected' => 'bg-red-100 text-red-700'
                            ][$status] ?? 'bg-gray-100 text-gray-700';
                        @endphp

                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3">{{ $log->date }}</td>
                            <td>{{ $log->start_time }}</td>
                            <td>{{ $log->end_time }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($log->start_time)->floatDiffInHours(\Carbon\Carbon::parse($log->end_time)) }}h
                            </td>
                            <td>
                                <span class="px-2 py-1 text-xs rounded-full {{ $badge }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection