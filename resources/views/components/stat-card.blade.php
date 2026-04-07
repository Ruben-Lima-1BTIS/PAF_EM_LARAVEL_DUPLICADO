<div {{ $attributes->merge([
    'class' => ' h-full w-full bg-white rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow p-6'
]) }}>
    <div class="flex items-center justify-between">
        
        <div>
            <h3 class="text-sm font-medium text-gray-500 mb-1">
                {{ $title }}
            </h3>

            <p class="text-3xl font-bold text-gray-900">
                {{ $value }}
            </p>
        </div>

        @isset($icon)
            <div class="bg-blue-100 rounded-full p-3">
                <x-dynamic-component :component="$icon" class="w-6 h-6 text-blue-600" />
            </div>
        @endisset

    </div>
</div>
