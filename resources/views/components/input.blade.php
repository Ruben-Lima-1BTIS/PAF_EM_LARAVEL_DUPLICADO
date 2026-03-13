@props([
    'name',
    'label' => null,
    'type' => 'text',
    'value' => '',
    'required' => false,
    'placeholder' => ''
])

@if($label)
    <label class="block mb-2 font-semibold" for="{{ $name }}">
        {{ $label }}
    </label>
@endif

<input 
    type="{{ $type }}" 
    name="{{ $name }}" 
    id="{{ $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge(['class' => 'border p-2 w-full mb-4']) }}
>

@error($name)
    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
@enderror
