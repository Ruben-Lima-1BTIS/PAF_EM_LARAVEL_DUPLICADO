@props(['class' => ''])

<div {{ $attributes->merge([
    'class' => "
        bg-white
        rounded-2xl
        border border-slate-300
        shadow-[0_1px_3px_rgba(59,130,246,0.1)]
        transition-all duration-200
        p-8
        hover:shadow-[0_6px_16px_rgba(59,130,246,0.15)]
        hover:-translate-y-1
        {$class}
    "
]) }}>
    {{ $slot }}
</div>