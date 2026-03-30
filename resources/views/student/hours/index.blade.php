@extends('layouts.auth')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');

.hours-page * {
    font-family: 'Sora', sans-serif;
}

.hours-page {
    background: #f5f8fa; /* very light blue-gray */
    min-height: 100vh;
}

/* HEADER */
.page-header {
    position: relative;
    padding-bottom: 1.5rem;
    margin-bottom: 0.5rem;
}
.page-header::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0;
    width: 48px; height: 3px;
    background: #60a5fa; /* subtle blue underline */
    border-radius: 9999px;
}
.page-header h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: black; /* dark blue */
    letter-spacing: -0.03em;
    margin-bottom: 0.35rem;
}
.page-header p {
    font-size: 0.875rem;
    color: #000000; /* medium blue */
}

/* CARD */
.card {
    background: #fff;
    border-radius: 1rem;
    border: 1px solid #dbeafe; /* subtle blue border */
    box-shadow: 0 1px 3px rgba(59,130,246,0.1);
    transition: 0.2s ease;
}
.card:hover {
    box-shadow: 0 6px 16px rgba(59,130,246,0.15);
}
.card-body { padding: 1.75rem; }

.section-label {
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #000000;
    margin-bottom: 0.25rem;
}

.card-title {
    font-size: 1.05rem;
    font-weight: 600;
    color: #000000;
    margin-bottom: 1.5rem;
}

/* BUTTON */
.btn-submit {
    width: 100%;
    background: #3b82f6; /* main blue */
    color: #fff;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease;
}
.btn-submit:hover {
    background: #2563eb; /* darker blue hover */
    transform: translateY(-1px);
}

/* STAT CARD */
.stat-card {
    display: flex;
    align-items: center;
    gap: 1.25rem;
}
.stat-icon-wrap {
    width: 52px; height: 52px;
    border-radius: 0.875rem;
    background: #dbeafe; /* light blue background */
    display: flex; align-items: center; justify-content: center;
    color: #3b82f6;
}
.stat-label {
    font-size: 0.78rem;
    color: #000000;
}
.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: #000000;
    letter-spacing: -0.04em;
}

/* TABLE */
.logs-table {
    width: 100%;
    border-collapse: collapse;
}
.logs-table thead th {
    padding: 0.6rem 0.75rem;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #424242; /* muted blue headers */
    text-align: left;
}
.logs-table tbody tr {
    border-top: 1px solid #dbeafe;
    transition: 0.15s ease;
}
.logs-table tbody tr:hover {
    background: #eff6ff;
}
.logs-table td {
    padding: 0.9rem 0.75rem;
    font-size: 0.85rem;
    color: #000000;
}

/* BADGES */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.25rem 0.65rem;
    border-radius: 9999px;
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: capitalize;
}
.badge-pending  { background: #fef9c3; color: #a16207; }   /* yellow */
.badge-approved { background: #dcfce7; color: #15803d; }   /* green */
.badge-rejected { background: #fee2e2; color: #b91c1c; }   /* red */
.badge-default  { background: #f1f5f9; color: #475569; }   /* gray */

.date-cell {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.75rem;
    color: #60a5fa;
}

/* ANIMATION */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}
.fade-up { animation: fadeUp 0.4s ease both; }
</style>

<div class="hours-page">
<div class="max-w-6xl mx-auto p-6 space-y-8">

    {{-- HEADER --}}
    <div class="page-header fade-up">
        <h2>Log Hours</h2>
        <p>Track and manage your internship time</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- FORM --}}
        <div class="lg:col-span-1 card fade-up">
            <div class="card-body">
                <p class="section-label">Entry</p>
                <h3 class="card-title">Add Hours</h3>

                <form action="{{ route('log.hours') }}" method="POST" class="space-y-5">
                    @csrf

                    <x-input name="date" type="date" label="Date" required />

                    <div class="grid grid-cols-2 gap-3">
                        <x-input name="start_time" type="time" label="Start" required />
                        <x-input name="end_time" type="time" label="End" required />
                    </div>

                    <button class="btn-submit">
                        Log Hours
                    </button>
                </form>
            </div>
        </div>

        {{-- STATS --}}
        <div class="lg:col-span-2 card fade-up">
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

    {{-- TABLE --}}
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
                                    'pending'  => 'badge-pending',
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

