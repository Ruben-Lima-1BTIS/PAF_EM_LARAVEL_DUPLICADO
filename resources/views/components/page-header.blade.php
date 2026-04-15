@props([
    'title',
    'subtitle',
])

<div class="
    relative pb-6 mb-2
    after:content-[''] after:absolute after:bottom-0 after:left-0
    after:w-12 after:h-[3px] after:bg-slate-400 after:rounded-full
">
    <h2 class="text-[1.75rem] font-bold text-black tracking-[-0.03em] mb-[0.35rem]">
        {{ $title }}
    </h2>

    <p class="text-[0.875rem] text-black">
        {{ $subtitle }}
    </p>
</div>