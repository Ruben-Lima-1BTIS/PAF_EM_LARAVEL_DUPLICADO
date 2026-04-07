@props([
    'title' => '',
    'value' => '',
    'icon' => null
])

<div {{ $attributes->merge([
    'class' => 'h-full w-full flex items-center justify-center'
]) }}>
    <div class="flex flex-col items-center gap-4 text-center">
        @isset($icon)
            <x-icon-wrap>
                <x-dynamic-component :component="$icon" class="w-6 h-6" />
            </x-icon-wrap>
        @endisset
        <p class="text-2xl font-bold text-gray-900">{{ $value }}</p>
        <p class="text-sm text-gray-500">{{ $title }}</p>
    </div>
</div>