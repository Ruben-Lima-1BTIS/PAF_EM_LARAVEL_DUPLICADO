@props([
    'name',
    'label' => null,
    'required' => false,
    'options' => [],
])

@if($label)
    <label for="{{ $name }}" class="block mb-2 font-semibold">
        {{ $label }}
    </label>
@endif

<select
    name="{{ $name }}"
    {{ $required ? 'required' : '' }}
    {{ $attributes->merge([
        'id' => $attributes->get('id') ?? $name,
        'class' => 'border p-2 w-full mb-4'
    ]) }}
>
    <option value="">Seleciona uma opção</option>

    @foreach($options as $option)
        <option value="{{ $option['id'] }}">
            {{ $option['name'] }}
        </option>
    @endforeach
</select>

@error($name)
    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
@enderror
