<div {{ $attributes->merge([
    'class' => 'w-[50px] h-[50px] rounded-[0.8rem] bg-neutral-200 
                flex items-center justify-center text-slate-700 mb-4'
]) }}>
    {{ $slot }}
</div>
