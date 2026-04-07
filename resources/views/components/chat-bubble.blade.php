@props([
    'user' => false,
    'admin' => false,
])

@php
    $isUser = $user;
    $isAdmin = $admin;

    $base = "max-w-[60%] px-4 py-3 rounded-2xl relative text-[0.875rem] leading-[1.25rem]";

    $styles = $isUser
        ? "bg-blue-500 text-white self-end rounded-br-[0.25rem]
           after:content-[''] after:absolute after:w-0 after:h-0
           after:border-l-[8px] after:border-l-blue-500
           after:border-y-[8px] after:border-y-transparent
           after:right-[-8px] after:top-[12px]"
        : "bg-indigo-100 text-slate-800 self-start rounded-bl-[0.25rem]
           after:content-[''] after:absolute after:w-0 after:h-0
           after:border-r-[8px] after:border-r-indigo-100
           after:border-y-[8px] after:border-y-transparent
           after:left-[-8px] after:top-[12px]";
@endphp

<div {{ $attributes->merge(['class' => "$base $styles"]) }}>
    {{ $slot }}
</div>
