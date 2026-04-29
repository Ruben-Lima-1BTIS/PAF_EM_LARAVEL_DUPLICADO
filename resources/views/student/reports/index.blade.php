@extends('layouts.auth')
@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-6xl mx-auto p-6 space-y-8 fade-up">

            <x-page-header title="Submit Report" subtitle="Upload your internship progress reports" />

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 fade-up">

                <x-primary-card class="lg:col-span-2">
                    <div class="p-7">
                        <p class="text-[0.7rem] font-semibold tracking-[0.12em] uppercase text-black mb-1">Upload</p>
                        <h3 class="text-[1.05rem] font-semibold text-black mb-6">New Report</h3>

                        <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-5">
                            @csrf
                            <x-input name="internship_id" type="hidden" :value="$internship->id" />

                            <div>
                                <label class="form-label">Report File</label>
                                <div class="file-upload-wrapper" id="drop-zone">
                                    <input type="file" name="report_file" required id="report-file-input"
                                        onchange="updateFileName(this)">
                                    <x-dynamic-component :component="'fas-cloud-arrow-up'" class="file-upload-icon" />
                                    <p class="file-upload-text"><strong>Click to browse</strong> or drag & drop</p>
                                    <p class="file-upload-hint">PDF, DOCX, ZIP — any format accepted</p>
                                </div>
                                <div id="file-name-display"></div>
                            </div>

                            <x-submit-button type="submit" color="bg-blue-600 hover:bg-blue-600">
                                Submit Report
                            </x-submit-button>
                        </form>
                    </div>
                </x-primary-card>

                <x-primary-card class="lg:col-span-1">
                    <x-primary-stat-card title="Total Reports Submitted" :value="$totalReports" icon="fas-file-alt" />
                </x-primary-card>

            </div>

            <x-primary-card class="lg:col-span-3">
                <div class="p-7">
                    <p class="text-[0.7rem] font-semibold tracking-[0.12em] uppercase text-black mb-1">History</p>
                    <h3 class="text-[1.05rem] font-semibold text-black mb-6">Submitted Reports</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="px-3 py-2 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                                        File</th>
                                    <th
                                        class="px-3 py-2 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                                        Status</th>
                                    <th
                                        class="px-3 py-2 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                                        Reviewed By</th>
                                    <th
                                        class="px-3 py-2 text-[0.7rem] font-semibold tracking-[0.1em] uppercase text-[#424242] text-left">
                                        Submitted</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($reports as $report)
                                    @php
                                        $status = strtolower($report->status);
                                        $badge =
                                            [
                                                'pending' => 'badge-pending',
                                                'approved' => 'badge-approved',
                                                'rejected' => 'badge-rejected',
                                            ][$status] ?? 'badge-default';
                                    @endphp

                                    <tr class="border-t border-gray-300 transition-colors duration-150 hover:bg-gray-100">
                                        <td class="px-3 py-3 text-[0.85rem] text-black">
                                            <a href="{{ asset($report->file_path) }}" class="file-link" target="_blank">
                                                {{ $report->original_name }}
                                            </a>
                                        </td>
                                        <td class="px-3 py-3 text-[0.85rem] text-black">
                                            <span class="badge {{ $badge }}">{{ ucfirst($status) }}</span>
                                        </td>
                                        <td class="px-3 py-3 text-[0.85rem] text-black">
                                            @if ($report->reviewer?->name)
                                                <span class="reviewer-name flex items-center gap-2">
                                                    <span
                                                        class="reviewer-avatar">{{ strtoupper(substr($report->reviewer->name, 0, 1)) }}</span>
                                                    {{ $report->reviewer->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-200">—</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-3 text-[0.85rem] text-black">
                                            {{ $report->created_at }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-10">
                                            <div class="flex flex-col items-center justify-center gap-3 text-center">
                                                <x-dynamic-component :component="'fas-folder-open'" class="w-9 h-9 text-slate-700" />
                                                <p class="text-[0.9rem] text-slate-500">No reports submitted yet.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </x-primary-card>

        </div>
    </div>

    <script>
        function updateFileName(input) {
            const display = document.getElementById('file-name-display');
            if (input.files && input.files[0]) {
                display.innerHTML = '<span class="text-black">📎 ' + input.files[0].name + '</span>';
                display.style.display = 'block';
            } else {
                display.style.display = 'none';
            }
        }
    </script>
@endsection
