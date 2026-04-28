@props(['title', 'icon'])

<div class="bg-white border border-gray-300 rounded-xl px-8 py-7 max-w-lg">
    <div class="flex items-center gap-[0.625rem] mb-6 pb-4 border-b border-gray-100">
        <span class="flex items-center justify-center w-8 h-8 rounded-md bg-blue-200 text-blue-700 shrink-0">
            <x-dynamic-component :component="$icon" class="w-4 h-4" />
        </span>
        <h2 class="text-base font-semibold text-gray-900 tracking-tight">{{ $title }}</h2>
    </div>

    {{ $slot }}
</div>