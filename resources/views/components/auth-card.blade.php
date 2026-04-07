<div {{ $attributes->merge([
    'class' => 'bg-white rounded-2xl border border-blue-100 p-8
                shadow-sm shadow-blue-500/10 transition-all duration-200
                hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/15'
]) }}>
    {{ $slot }}
</div>
