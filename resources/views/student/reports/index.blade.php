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
                            <svg class="file-upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <p class="file-upload-text"><strong>Click to browse</strong> or drag & drop</p>
                            <p class="file-upload-hint">PDF, DOCX, ZIP — any format accepted</p>
                        </div>
                        <div id="file-name-display"></div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
                        </svg>
                        Submit Report
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-1 card fade-up fade-up-2">
            <div class="card-body" style="height:100%; display:flex; align-items:center;">
                <div class="stat-card">
                    <div class="stat-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
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
