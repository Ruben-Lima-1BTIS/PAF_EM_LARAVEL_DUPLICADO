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
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
                <x-stat-card title="Student Name"       :value="$stats['student']->name"   color="gray"   />
                <x-stat-card title="Pending Reports"    :value="$stats['totalPending']"    color="yellow" />
                <x-stat-card title="Approved Reports"   :value="$stats['totalApproved']"   color="green"  />
                <x-stat-card title="Rejected Reports"   :value="$stats['totalRejected']"   color="red"    />
            </div>

            @if($pendingReports->count() > 0)
                <div class="bg-white rounded-lg shadow mb-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Pending Reports</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Internship</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">File</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Submitted</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($pendingReports as $report)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $report->internship->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $report->original_name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <div class="flex gap-2">
                                            <button type="button"
                                                @click="$dispatch('open-review-modal', { id: {{ $report->id }}, action: 'approve' })"
                                                class="px-3 py-1 rounded bg-green-100 hover:bg-green-200 text-green-700 text-sm font-medium">
                                                Approve
                                            </button>
                                            <button type="button"
                                                @click="$dispatch('open-review-modal', { id: {{ $report->id }}, action: 'reject' })"
                                                class="px-3 py-1 rounded bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium">
                                                Reject
                                            </button>
                                            <a href="{{ $report->file_path }}" target="_blank"
                                                class="px-3 py-1 rounded bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium">
                                                View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @foreach([
                'approved' => ['label' => 'Approved Reports', 'reports' => $approvedReports],
                'rejected' => ['label' => 'Rejected Reports', 'reports' => $rejectedReports],
            ] as $status => $group)
                @if($group['reports']->count() > 0)
                <div class="bg-white rounded-lg shadow mb-8">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">{{ $group['label'] }}</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Internship</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">File</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Reviewed By</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Reviewed</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($group['reports'] as $report)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $report->internship->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $report->original_name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $report->reviewer->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $report->reviewed_at?->format('d/m/Y H:i') ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <a href="{{ $report->file_path }}" target="_blank"
                                            class="px-3 py-1 rounded bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-medium">
                                            View
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            @endforeach

            @if($pendingReports->count() === 0 && $approvedReports->count() === 0 && $rejectedReports->count() === 0)
                <x-empty-state message="No reports found for this student" />
            @endif

        @else
            <x-empty-state message="Please select a student to view their reports" />
        @endif

    </div>
</div>

<!-- Single unified modal for both Approve and Reject -->
<div x-data="{
        open: false,
        reportId: null,
        action: null,
        loading: false,
        init() {
            window.addEventListener('open-review-modal', (e) => {
                this.reportId = e.detail.id;
                this.action   = e.detail.action;
                this.open     = true;
                this.loading  = false;
            });
        },
        get isApprove() { return this.action === 'approve' },
        get actionUrl() { return `/report-approval/${this.reportId}/${this.action}` },
    }"
    x-show="open"
    x-transition.opacity
    x-cloak
    @keydown.escape.window="open = false"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 backdrop-blur-sm">

    <div class="absolute inset-0" @click="open = false"></div>

    <div x-show="open" x-transition.scale class="relative bg-white rounded-lg shadow-xl w-full max-w-md p-6">

        <h3 class="text-lg font-semibold text-gray-900 mb-2" x-text="isApprove ? 'Approve Report?' : 'Reject Report?'"></h3>
        <p class="text-gray-600 mb-6" x-text="isApprove ? 'Are you sure you want to approve this report?' : 'Are you sure you want to reject this report?'"></p>

        <form method="POST" :action="actionUrl" @submit="loading = true" class="flex gap-3">
            @csrf

            <button type="submit"
                :class="isApprove ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'"
                class="px-4 py-2 rounded text-white disabled:opacity-50"
                :disabled="loading">
                <span x-show="!loading" x-text="isApprove ? 'Approve' : 'Reject'"></span>
                <span x-show="loading">Loading...</span>
            </button>

            <button type="button" @click="open = false"
                class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700"
                :disabled="loading">
                Cancel
            </button>
        </form>
    </div>
</div>

@endsection