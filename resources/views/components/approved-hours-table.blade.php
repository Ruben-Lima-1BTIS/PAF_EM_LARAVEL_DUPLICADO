<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900">
            Approved Hours ({{ $hours->count() }})
        </h2>
    </div>

    @if($hours->isEmpty())
    <div class="p-6 text-center">
        <p class="text-gray-500">No approved hours yet</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Approved At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Comment</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($hours as $hour)
                <tr class="hover:bg-gray-50">

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($hour->date)->format('M d, Y') }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $hour->duration_hours }}h
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $hour->reviewed_at
                                    ? \Carbon\Carbon::parse($hour->reviewed_at)->format('M d, Y H:i')
                                    : 'N/A' }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $hour->supervisor_comment ?? '-' }}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>