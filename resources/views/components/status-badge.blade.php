@props(['status'])

@php
$colors = [
    'pending' => 'bg-yellow-100 text-yellow-800',
    'approved' => 'bg-green-100 text-green-800',
    'rejected' => 'bg-red-100 text-red-800',
];
$classes = $colors[$status] ?? 'bg-gray-100 text-gray-800';
@endphp

<span class="px-2 py-1 rounded text-xs font-semibold {{ $classes }}">
    {{ ucfirst($status) }}
</span>