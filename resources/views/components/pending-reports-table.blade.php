@if($reports->count() > 0)
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900">Pending Reports</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-blue-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Internship</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">File</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Submitted</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($reports as $report)
                <tr class="hover:bg-blue-50">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $report->internship->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $report->original_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $report->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex gap-2">
                            <button type="button" x-data="{}"
                                @click="$dispatch('open-review-modal', { id: {{ $report->id }}, action: 'approve' })"
                                class="px-3 py-1 rounded bg-green-100 hover:bg-green-200 text-green-700 text-sm font-medium">
                                Approve
                            </button>
                            <button type="button" x-data="{}"
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