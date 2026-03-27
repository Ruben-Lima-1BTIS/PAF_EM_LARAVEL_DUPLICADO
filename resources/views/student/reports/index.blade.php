@extends('layouts.auth')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');

    .report-page * {
        font-family: 'Sora', sans-serif;
    }

    .report-page {
        --teal-50:  #f0fdfa;
        --teal-100: #ccfbf1;
        --teal-500: #14b8a6;
        --teal-600: #0d9488;
        --teal-700: #0f766e;
        --slate-50: #f8fafc;
        --slate-100: #f1f5f9;
        --slate-200: #e2e8f0;
        --slate-400: #94a3b8;
        --slate-500: #64748b;
        --slate-600: #475569;
        --slate-700: #334155;
        --slate-800: #1e293b;
        --slate-900: #0f172a;
        background: linear-gradient(135deg, #f0fdfa 0%, #f8fafc 50%, #f1f5f9 100%);
        min-height: 100vh;
    }

    /* ── PAGE HEADER ── */
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
        background: linear-gradient(90deg, var(--teal-500), var(--teal-700));
        border-radius: 9999px;
    }
    .page-header h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--slate-900);
        letter-spacing: -0.03em;
        line-height: 1.2;
        margin-bottom: 0.35rem;
    }
    .page-header p {
        font-size: 0.875rem;
        color: var(--slate-500);
        font-weight: 400;
        letter-spacing: 0.01em;
    }

    /* ── CARDS ── */
    .card {
        background: #ffffff;
        border-radius: 1rem;
        border: 1px solid var(--slate-200);
        box-shadow: 0 1px 3px rgba(15,23,42,0.04), 0 4px 16px rgba(15,23,42,0.06);
        transition: box-shadow 0.2s ease;
    }
    .card:hover {
        box-shadow: 0 2px 6px rgba(15,23,42,0.06), 0 8px 24px rgba(15,23,42,0.09);
    }
    .card-body { padding: 1.75rem; }

    /* ── SECTION LABEL ── */
    .section-label {
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--teal-600);
        margin-bottom: 0.25rem;
    }
    .card-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--slate-800);
        letter-spacing: -0.02em;
        margin-bottom: 1.5rem;
    }

    /* ── FORM ── */
    .form-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--slate-600);
        margin-bottom: 0.5rem;
        letter-spacing: 0.01em;
    }

    .file-upload-wrapper {
        position: relative;
        border: 2px dashed var(--slate-200);
        border-radius: 0.75rem;
        padding: 1.5rem 1rem;
        text-align: center;
        background: var(--slate-50);
        transition: border-color 0.2s ease, background 0.2s ease;
        cursor: pointer;
    }
    .file-upload-wrapper:hover {
        border-color: var(--teal-500);
        background: var(--teal-50);
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
        color: var(--teal-500);
    }
    .file-upload-text {
        font-size: 0.82rem;
        color: var(--slate-500);
    }
    .file-upload-text strong {
        color: var(--teal-600);
        font-weight: 600;
    }
    .file-upload-hint {
        font-size: 0.72rem;
        color: var(--slate-400);
        margin-top: 0.25rem;
    }
    #file-name-display {
        margin-top: 0.75rem;
        font-size: 0.78rem;
        font-family: 'JetBrains Mono', monospace;
        color: var(--teal-700);
        background: var(--teal-50);
        border: 1px solid var(--teal-100);
        border-radius: 0.5rem;
        padding: 0.4rem 0.75rem;
        display: none;
        text-align: left;
        word-break: break-all;
    }

    .btn-submit {
        width: 100%;
        background: linear-gradient(135deg, var(--teal-600) 0%, var(--teal-700) 100%);
        color: #fff;
        border: none;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.01em;
        cursor: pointer;
        transition: opacity 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
        box-shadow: 0 4px 14px rgba(13,148,136,0.3);
        font-family: 'Sora', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    .btn-submit:hover {
        opacity: 0.92;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(13,148,136,0.38);
    }
    .btn-submit:active { transform: translateY(0); }

    /* ── STAT CARD ── */
    .stat-card {
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }
    .stat-icon-wrap {
        width: 52px; height: 52px;
        border-radius: 0.875rem;
        background: linear-gradient(135deg, var(--teal-50), var(--teal-100));
        border: 1px solid var(--teal-100);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        color: var(--teal-600);
    }
    .stat-label {
        font-size: 0.78rem;
        color: var(--slate-500);
        font-weight: 500;
        letter-spacing: 0.02em;
        margin-bottom: 0.15rem;
    }
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: var(--slate-900);
        letter-spacing: -0.04em;
        line-height: 1;
    }

    /* ── TABLE ── */
    .reports-table {
        width: 100%;
        border-collapse: collapse;
    }
    .reports-table thead tr {
        border-bottom: 2px solid var(--slate-100);
    }
    .reports-table thead th {
        padding: 0.6rem 0.75rem;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--slate-400);
        text-align: left;
        white-space: nowrap;
    }
    .reports-table tbody tr {
        border-bottom: 1px solid var(--slate-100);
        transition: background 0.15s ease;
    }
    .reports-table tbody tr:last-child { border-bottom: none; }
    .reports-table tbody tr:hover { background: var(--slate-50); }
    .reports-table td {
        padding: 0.9rem 0.75rem;
        font-size: 0.85rem;
        color: var(--slate-700);
        vertical-align: middle;
    }

    .file-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--teal-600);
        font-weight: 500;
        font-size: 0.84rem;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .file-link:hover { color: var(--teal-700); text-decoration: underline; }
    .file-link svg { flex-shrink: 0; }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.65rem;
        border-radius: 9999px;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        text-transform: capitalize;
    }
    .badge::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: currentColor;
        opacity: 0.7;
        flex-shrink: 0;
    }
    .badge-pending  { background: #fef9c3; color: #a16207; }
    .badge-approved { background: #dcfce7; color: #15803d; }
    .badge-rejected { background: #fee2e2; color: #b91c1c; }
    .badge-default  { background: var(--slate-100); color: var(--slate-600); }

    .reviewer-name {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.84rem;
        color: var(--slate-700);
    }
    .reviewer-avatar {
        width: 24px; height: 24px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--teal-500), var(--teal-700));
        color: #fff;
        font-size: 0.6rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .comment-cell {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: var(--slate-500);
        font-size: 0.82rem;
        font-style: italic;
    }

    .date-cell {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        color: var(--slate-400);
        white-space: nowrap;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--slate-400);
    }
    .empty-state svg {
        margin: 0 auto 0.75rem;
        color: var(--slate-300);
    }
    .empty-state p { font-size: 0.875rem; }

    /* ── FADE IN ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }
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

    {{-- GRID --}}
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
                            <input type="file"
                                   name="report_file"
                                   required
                                   id="report-file-input"
                                   onchange="updateFileName(this)">
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
                                    <a href="{{ asset($report->file_path) }}"
                                       class="file-link"
                                       target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                        {{ $report->original_name }}
                                    </a>
                                </td>

                                <td>
                                    <span class="badge {{ $badge }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>

                                <td>
                                    @if($report->reviewer?->name)
                                        <span class="reviewer-name">
                                            <span class="reviewer-avatar">
                                                {{ strtoupper(substr($report->reviewer->name, 0, 1)) }}
                                            </span>
                                            {{ $report->reviewer->name }}
                                        </span>
                                    @else
                                        <span style="color:var(--slate-300)">—</span>
                                    @endif
                                </td>

                                <td class="comment-cell" title="{{ $report->supervisor_comment }}">
                                    {{ $report->supervisor_comment ?? '—' }}
                                </td>

                                <td class="date-cell">
                                    {{ $report->created_at }}
                                </td>
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

{{-- 
@extends('layouts.auth')
@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-8">
    <div>
        <h2 class="text-2xl font-semibold text-gray-800">Submit Report</h2>
        <p class="text-gray-500 text-sm">Upload your internship progress reports</p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1 bg-white p-6 rounded-xl shadow-md border">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Upload Report</h3>
            <form action="{{ route('reports.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data"
                  class="space-y-4">
                @csrf
                <x-input name="internship_id" type="hidden" value="{{ $internship->id }}" />
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Report File</label>
                    <input type="file" 
                           name="report_file" 
                           required
                           class="w-full border rounded-lg px-3 py-2 focus:ring-teal-500 focus:border-teal-500">
                </div>
                <button 
                    class="w-full bg-teal-600 hover:bg-teal-700 text-white py-2.5 rounded-lg transition font-medium">
                    Submit Report
                </button>
            </form>
        </div>
        <div class="lg:col-span-2 bg-white p-4 rounded-xl shadow-md border flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Reports Submitted</p>
                <p class="text-lg font-semibold text-gray-800">{{ $totalReports }}</p>
            </div>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-md border">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Submitted Reports</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="border-b text-gray-500 text-sm">
                    <tr>
                        <th class="text-left py-2">File</th>
                        <th class="text-left py-2">Status</th>
                        <th class="text-left py-2">Reviewed By</th>
                        <th class="text-left py-2">Comment</th>
                        <th class="text-left py-2">Submitted</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($reports as $report)
                        @php
                            $status = strtolower($report->status);
                            $badge = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'approved' => 'bg-green-100 text-green-700',
                                'rejected' => 'bg-red-100 text-red-700'
                            ][$status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3">
                                <a href="{{ asset($report->file_path) }}" 
                                   class="text-teal-600 hover:underline"
                                   target="_blank">
                                    {{ $report->original_name }}
                                </a>
                            </td>
                            <td>
                                <span class="px-2 py-1 text-xs rounded-full {{ $badge }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            <td>
                                {{ $report->reviewer?->name ?? '—' }}
                            </td>
                            <td class="max-w-xs truncate">
                                {{ $report->supervisor_comment ?? '—' }}
                            </td>
                            <td>
                                {{ $report->created_at }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
 --}}