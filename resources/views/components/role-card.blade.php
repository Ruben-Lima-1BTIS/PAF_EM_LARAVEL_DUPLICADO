<div class="bg-white rounded-2xl border border-blue-100 p-8
                shadow-sm shadow-blue-500/10 transition-all duration-200
                hover:-translate-y-1 hover:shadow-lg hover:shadow-blue-500/15">
    <x-icon-wrap>
        {{$icon}}
    </x-icon-wrap>

    <h3 class="text-lg font-semibold text-slate-800 mb-4">
        {{ $title }}
    </h3>
    
    <ul class="space-y-2 text-slate-600 text-sm">
        @foreach ($items as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>