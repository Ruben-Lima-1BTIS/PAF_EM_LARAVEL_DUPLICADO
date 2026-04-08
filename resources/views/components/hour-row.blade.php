@props(['log'])

@php
    $status = strtolower($log->status);
@endphp

<tr class="border-t border-blue-100 transition-colors duration-150 hover:bg-blue-50">
    <td class="px-3 py-3 text-[0.85rem] text-black">{{ $log->date }}</td>
    <td class="px-3 py-3 text-[0.85rem] text-black">{{ $log->start_time }}</td>
    <td class="px-3 py-3 text-[0.85rem] text-black">{{ $log->end_time }}</td>
    <td class="px-3 py-3 text-[0.85rem] text-black">{{ $log->duration_hours}}h</td>
    <td class="px-3 py-3 text-[0.85rem] text-black">
        <x-status-badge :status="$status" />
    </td>
</tr>