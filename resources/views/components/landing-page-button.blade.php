<a {{ $attributes->merge([
    'class' => 'bg-neutral-400 text-black px-7 py-3 rounded-xl font-semibold text-sm
                shadow-lg shadow-slate-600/30 transition duration-200 ease-out inline-block
                hover:-translate-y-0.5 hover:shadow-xl hover:shadow-neutral-400/40'
]) }}>
    {{ $slot }}
</a>
