@props(['title', 'icon', 'action', 'buttonText' => $title])

<div class="bg-white border border-gray-300 rounded-xl px-8 py-7 max-w-xl">
    <div class="flex items-center gap-[0.625rem] mb-6 pb-4 border-b border-gray-100">
        <span class="flex items-center justify-center w-8 h-8 rounded-md bg-blue-200 text-blue-700 shrink-0">
            <x-dynamic-component :component="$icon" class="w-4 h-4" />
        </span>
        <h2 class="text-base font-semibold text-gray-900 tracking-tight">{{ $title }}</h2>
    </div>

    <form action="{{ $action }}" method="POST" class="flex flex-col gap-4">
        @csrf
        {{ $slot }}
        <div class="flex justify-end pt-3 mt-1 border-t border-gray-100">
            <button type="submit" class="inline-flex items-center gap-[0.4rem] px-[1.125rem] py-2 
                rounded-md text-sm font-medium text-white bg-blue-600 
                shadow-sm hover:bg-blue-600 transition">
                <x-dynamic-component :component="$icon" class="w-3.5 h-3.5" />
                {{ $buttonText }}
            </button>
        </div>
    </form>
</div>