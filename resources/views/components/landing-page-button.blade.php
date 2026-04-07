<a {{ $attributes->merge([
    'class' => 'bg-blue-600 text-white px-7 py-3 rounded-xl font-semibold text-sm
                shadow-lg shadow-blue-600/30 transition duration-200 ease-out inline-block
                hover:-translate-y-0.5 hover:shadow-xl hover:shadow-blue-600/40'
]) }}>
    {{ $slot }}
</a>
