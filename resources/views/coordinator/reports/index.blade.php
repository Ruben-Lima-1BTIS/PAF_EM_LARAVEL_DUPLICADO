@extends('layouts.auth')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Report Approval</h1>
            <div class="bg-white rounded-lg shadow p-6">
                <form method="GET" action="{{ route('coordinator.reports.index') }}" id="studentForm">
                    <x-select
                        name="student_id"
                        label="Select Student"
                        :selected="$selectedStudentId"
                        :options="$cleanedStudents"
                        onchange="document.getElementById('studentForm').submit()" />
                </form>
            </div>
        </div>

        @if($stats)
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-8">
                <x-stat-card title="Student Name"     :value="$stats['student']->name" color="gray"   />
                <x-stat-card title="Pending Reports"  :value="$stats['totalPending']"  color="yellow" />
                <x-stat-card title="Approved Reports" :value="$stats['totalApproved']" color="green"  />
                <x-stat-card title="Rejected Reports" :value="$stats['totalRejected']" color="red"    />
            </div>

            <x-pending-reports-table :reports="$pendingReports" />
            <x-reviewed-reports-table :reports="$approvedReports" label="Approved Reports" />
            <x-reviewed-reports-table :reports="$rejectedReports" label="Rejected Reports" />

            @if($pendingReports->count() === 0 && $approvedReports->count() === 0 && $rejectedReports->count() === 0)
                <x-empty-state message="No reports found for this student" />
            @endif
        @else
            <x-empty-state message="Please select a student to view their reports" />
        @endif

    </div>
</div>

<x-report-review-modal />
@endsection