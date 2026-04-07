@props(['type' => 'button', 'color' => 'bg-blue-600 hover:bg-blue-700', 'click' => null])

<button type="{{ $type }}" class="btn-submit {{ $color }}" @click="{{ $click ?? '' }}">
    {{ $slot }}
</button>

