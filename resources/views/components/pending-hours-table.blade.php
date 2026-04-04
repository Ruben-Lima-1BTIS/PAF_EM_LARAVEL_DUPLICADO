<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 bg-gray-100 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-900">
            Pending Hours ({{ $hours->count() }})
        </h2>
    </div>

    @if($hours->isEmpty())
    <div class="p-6 text-center">
        <p class="text-gray-500">No pending hours to review</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Internship</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">End</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($hours as $hour)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $hour->student->name }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $hour->internship->company->name ?? 'N/A' }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($hour->date)->format('M d, Y') }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($hour->start_time)->format('H:i') }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($hour->end_time)->format('H:i') }}
                    </td>

                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $hour->duration_formatted }}
                    </td>

                    <td class="px-6 py-4 text-center text-sm space-x-2">

                        <button type="button" x-data="{}"
                            @click="$dispatch('open-approve', { id: {{ $hour->id }} })"
                            class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                            Approve
                        </button>

                        <button type="button" x-data="{}"
                            @click="$dispatch('open-reject', { id: {{ $hour->id }} })"
                            class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                            Reject
                        </button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>