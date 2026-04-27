@if($reports->count() > 0)
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900">{{ $label }}</h2>
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
                @foreach($reports as $report)
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