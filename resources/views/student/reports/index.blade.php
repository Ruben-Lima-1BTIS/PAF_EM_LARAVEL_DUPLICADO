@extends('layouts.auth')

@section('content')

<div class="report-page">
<div class="max-w-6xl mx-auto p-6 space-y-8">

    <div class="page-header fade-up">
        <h2>Submit Report</h2>
        <p>Upload your internship progress reports</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 card fade-up fade-up-1">
            <div class="card-body">
                <p class="section-label">Upload</p>
                <h3 class="card-title">New Report</h3>

                <form action="{{ route('reports.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-5">
                    @csrf
                    <x-input name="internship_id" type="hidden" value="{{ $internship->id }}" />

                    <div>
                        <label class="form-label">Report File</label>
                        <div class="file-upload-wrapper" id="drop-zone">
                            <input type="file" name="report_file" required id="report-file-input" onchange="updateFileName(this)">
                            <x-dynamic-component :component="'fas-cloud-arrow-up'" class="file-upload-icon" />
                            <p class="file-upload-text"><strong>Click to browse</strong> or drag & drop</p>
                            <p class="file-upload-hint">PDF, DOCX, ZIP — any format accepted</p>
                        </div>
                        <div id="file-name-display"></div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <x-dynamic-component :component="'fas-file-arrow-up'" class="w-4 h-4" />
                        Submit Report
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1 card fade-up fade-up-2">
            <div class="card-body" style="height:100%; display:flex; align-items:center;">
                <div class="stat-card">
                    <div class="stat-icon-wrap">
                        <x-dynamic-component :component="'fas-file-lines'" class="w-5 h-5" />
                    </div>
                    <div>
                        <p class="stat-label">Total Reports Submitted</p>
                        <p class="stat-value">{{ $totalReports }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card fade-up fade-up-3">
        <div class="card-body">
            <p class="section-label">History</p>
            <h3 class="card-title" style="margin-bottom:1.25rem;">Submitted Reports</h3>

            <div class="overflow-x-auto">
                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>File</th>
                            <th>Status</th>
                            <th>Reviewed By</th>
                            <th>Comment</th>
                            <th>Submitted</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reports as $report)
                            @php
                                $status = strtolower($report->status);
                                $badge = [
                                    'pending'  => 'badge-pending',
                                    'approved' => 'badge-approved',
                                    'rejected' => 'badge-rejected'
                                ][$status] ?? 'badge-default';
                            @endphp
                            <tr>
                                <td>
                                    <a href="{{ asset($report->file_path) }}" class="file-link" target="_blank">
                                        {{ $report->original_name }}
                                    </a>
                                </td>
                                <td><span class="badge {{ $badge }}">{{ ucfirst($status) }}</span></td>
                                <td>
                                    @if($report->reviewer?->name)
                                        <span class="reviewer-name">
                                            <span class="reviewer-avatar">{{ strtoupper(substr($report->reviewer->name, 0, 1)) }}</span>
                                            {{ $report->reviewer->name }}
                                        </span>
                                    @else
                                        <span style="color:#dbeafe">—</span>
                                    @endif
                                </td>
                                <td class="comment-cell" title="{{ $report->supervisor_comment }}">
                                    {{ $report->supervisor_comment ?? '—' }}
                                </td>
                                <td class="date-cell">{{ $report->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <x-dynamic-component :component="'fas-folder-open'" class="w-9 h-9" />
                                        <p>No reports submitted yet.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</div>

@endsection
