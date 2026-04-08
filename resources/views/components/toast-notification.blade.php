@props([
    'type' => 'success', // 'success' or 'error'
    'message',
    'duration' => null
])

@php
    $colors = [
        'success' => [
            'bg' => 'bg-green-100',
            'text' => 'text-green-600',
            'border' => 'border-blue-100',
            'gradient' => 'from-green-300 to-green-500',
            'icon' => 'fas-circle-check',
            'timeout' => $duration ?? 3000
        ],
        'error' => [
            'bg' => 'bg-red-100',
            'text' => 'text-red-600',
            'border' => 'border-red-200',
            'gradient' => 'from-red-300 to-red-500',
            'icon' => 'fas-circle-exclamation',
            'timeout' => $duration ?? 4000
        ]
    ];
@endphp

<div
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transform transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transform transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    x-init="setTimeout(() => show = false, {{ $colors[$type]['timeout'] }})"
    class="
        relative flex items-center gap-5
        min-w-[480px] max-w-[580px]
        px-6 pt-6 pb-8
        bg-white rounded-[0.875rem]
        border {{ $colors[$type]['border'] }}
        shadow-[0_4px_16px_rgba(0,0,0,0.06)]
        font-sora
    "
>
    <div class="flex items-center justify-center w-14 h-14 rounded-[0.7rem] shrink-0 {{ $colors[$type]['bg'] }} {{ $colors[$type]['text'] }}">
        <x-dynamic-component :component="$colors[$type]['icon']" class="w-7 h-7" />
    </div>

    <div class="flex-1 min-w-0">
        <p class="text-[0.85rem] font-bold tracking-[0.08em] uppercase mb-1 {{ $colors[$type]['text'] }}">
            {{ ucfirst($type) }}
        </p>
        <p class="text-[1rem] text-slate-800 leading-[1.4] whitespace-nowrap overflow-hidden text-ellipsis font-medium">
            {{ $message }}
        </p>
    </div>

    <button
        @click="show = false"
        class="flex items-center justify-center w-8 h-8 rounded-md text-slate-400 bg-transparent cursor-pointer shrink-0 transition-colors hover:bg-blue-50 hover:text-blue-600"
    >
        <x-dynamic-component :component="'fas-xmark'" class="w-4 h-4" />
    </button>

    <div class="absolute bottom-0 left-0 h-[3px] w-full origin-left rounded-b-[0.875rem] bg-gradient-to-r {{ $colors[$type]['gradient'] }} animate-[drain_{{ $colors[$type]['timeout']/1000 }}s_linear_forwards]"></div>
</div>