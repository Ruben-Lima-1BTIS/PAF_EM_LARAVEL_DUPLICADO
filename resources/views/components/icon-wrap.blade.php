<div {{ $attributes->merge([
    'class' => 'w-[50px] h-[50px] rounded-[0.8rem] bg-blue-200 
                flex items-center justify-center text-blue-800 mb-4'
]) }}>
    {{ $slot }}
</div>
