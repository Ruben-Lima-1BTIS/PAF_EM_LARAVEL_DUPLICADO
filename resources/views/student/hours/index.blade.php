@extends('layouts.auth')

@section('content')

<div class="hours-page">
    <div class="max-w-6xl mx-auto p-6 space-y-8">
        <div class="page-header fade-up">
            <h2>Log Hours</h2>
            <p>Track and manage your internship time</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 card fade-up">
                <div class="card-body">
                    <p class="section-label">Entry</p>
                    <h3 class="card-title">Add Hours</h3>

                    <form action="{{ route('log.hours') }}" method="POST" class="space-y-5">
                        @csrf

                        <x-input name="date" type="date" label="Date" required />

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input name="start_time" type="time" label="Start" required />
                            </div>
                            <div>
                                <x-input name="end_time" type="time" label="End" required />
                            </div>
                        </div>

                        <button class="btn-submit">
                            Log Hours
                        </button>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1 card fade-up">
                <div class="card-body" style="height:100%; display:flex; align-items:center;">
                    <div class="stat-card">
                        <div class="stat-icon-wrap">
                            ⏱
                        </div>
                        <div>
                            <p class="stat-label">Total Hours Logged</p>
                            <p class="stat-value">{{ $totalHours }}h</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card fade-up">
            <div class="card-body">
                <p class="section-label">History</p>
                <h3 class="card-title" style="margin-bottom:1.25rem;">Recent Entries</h3>

                <div class="overflow-x-auto">
                    <table class="logs-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Hours</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            @php
                            $status = strtolower($log->status);
                            $badge = [
                            'pending' => 'badge-pending',
                            'approved' => 'badge-approved',
                            'rejected' => 'badge-rejected'
                            ][$status] ?? 'badge-default';
                            @endphp

                            <tr>
                                <td class="date-cell">{{ $log->date }}</td>
                                <td>{{ $log->start_time }}</td>
                                <td>{{ $log->end_time }}</td>
                                <td>
                                    {{ $log->hours_worked }}h
                                </td>
                                <td>
                                    <span class="badge {{ $badge }}">
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
    </div>
</div>
@endsection