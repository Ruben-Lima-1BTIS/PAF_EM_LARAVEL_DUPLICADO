@extends('layouts.auth')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');

.report-page * {
    font-family: 'Sora', sans-serif;
}

.report-page {
    background: #f5f8fa; /* light blue-gray */
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
    color: black;
    letter-spacing: -0.03em;
    margin-bottom: 0.35rem;
}
.page-header p {
    font-size: 0.875rem;
    color: #000000;
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

/* FILE UPLOAD */
.file-upload-wrapper {
    position: relative;
    border: 2px dashed #dbeafe;
    border-radius: 0.75rem;
    padding: 1.5rem 1rem;
    text-align: center;
    background: #eff6ff;
    cursor: pointer;
    transition: border-color 0.2s ease, background 0.2s ease;
}
.file-upload-wrapper:hover {
    border-color: #3b82f6;
    background: #e0f2fe;
}
.file-upload-wrapper input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}
.file-upload-icon {
    width: 36px; height: 36px;
    margin: 0 auto 0.6rem;
    color: #3b82f6;
}
.file-upload-text {
    font-size: 0.82rem;
    color: #000000;
}
.file-upload-text strong { color: #2563eb; }
.file-upload-hint {
    font-size: 0.72rem;
    color: #475569;
    margin-top: 0.25rem;
}
#file-name-display {
    margin-top: 0.75rem;
    font-size: 0.78rem;
    font-family: 'JetBrains Mono', monospace;
    color: #2563eb;
    background: #e0f2fe;
    border: 1px solid #dbeafe;
    border-radius: 0.5rem;
    padding: 0.4rem 0.75rem;
    display: none;
    text-align: left;
    word-break: break-all;
}

/* BUTTON */
.btn-submit {
    width: 100%;
    background: #3b82f6;
    color: #fff;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease, transform 0.15s ease;
    display: flex; align-items: center; justify-content: center; gap: 0.5rem;
}
.btn-submit:hover { background: #2563eb; transform: translateY(-1px); }

/* STAT CARD */
.stat-card { display: flex; align-items: center; gap: 1.25rem; }
.stat-icon-wrap {
    width: 52px; height: 52px;
    border-radius: 0.875rem;
    background: #dbeafe;
    display: flex; align-items: center; justify-content: center;
    color: #3b82f6;
}
.stat-label { font-size: 0.78rem; color: #000000; }
.stat-value { font-size: 2rem; font-weight: 700; color: #000000; letter-spacing: -0.04em; }

/* TABLE */
.reports-table {
    width: 100%;
    border-collapse: collapse;
}
.reports-table thead th {
    padding: 0.6rem 0.75rem;
    font-size: 0.7rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #424242;
    text-align: left;
}
.reports-table tbody tr {
    border-top: 1px solid #dbeafe;
    transition: 0.15s ease;
}
.reports-table tbody tr:hover { background: #eff6ff; }
.reports-table td {
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
.badge-pending  { background: #fef9c3; color: #a16207; }
.badge-approved { background: #dcfce7; color: #15803d; }
.badge-rejected { background: #fee2e2; color: #b91c1c; }
.badge-default  { background: #f1f5f9; color: #475569; }

.reviewer-name { display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.84rem; color: #000; }
.reviewer-avatar { width: 24px; height: 24px; border-radius: 50%; background: #3b82f6; color: #fff; font-size: 0.6rem; font-weight: 700; display: flex; align-items: center; justify-content: center; }

.comment-cell { max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; color: #475569; font-size: 0.82rem; font-style: italic; }
.date-cell { font-family: 'JetBrains Mono', monospace; font-size: 0.75rem; color: #60a5fa; }

/* EMPTY STATE */
.empty-state { text-align: center; padding: 3rem 1rem; color: #475569; }
.empty-state svg { margin: 0 auto 0.75rem; color: #dbeafe; }
.empty-state p { font-size: 0.875rem; }

/* ANIMATION */
@keyframes fadeUp { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
.fade-up { animation: fadeUp 0.4s ease both; }
.fade-up-1 { animation-delay: 0.05s; }
.fade-up-2 { animation-delay: 0.12s; }
.fade-up-3 { animation-delay: 0.2s; }

</style>

<div class="report-page">
<div class="max-w-6xl mx-auto p-6 space-y-8">

    {{-- TITLE --}}
    <div class="page-header fade-up">
        <h2>Submit Report</h2>
        <p>Upload your internship progress reports</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- FORM --}}
        <div class="lg:col-span-1 card fade-up fade-up-1">
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

        {{-- STATS --}}
        <div class="lg:col-span-2 card fade-up fade-up-2">
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

    {{-- TABLE --}}
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

<script>
function updateFileName(input) {
    const display = document.getElementById('file-name-display');
    if (input.files && input.files[0]) {
        display.textContent = '📎 ' + input.files[0].name;
        display.style.display = 'block';
    } else {
        display.style.display = 'none';
    }
}
</script>

@endsection
