@props([
'name',
'label' => null,
'type' => 'text',
'value' => '',
'required' => false,
'placeholder' => '',
'autocomplete' => null,
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
    @required($required)
    @if($autocomplete)
        autocomplete="{{ $autocomplete }}"
    @endif
    aria-invalid="{{ $errors->has($name) ? 'true' : 'false' }}"
    @if($errors->has($name))
        aria-describedby="{{ $name }}-error"
    @endif
    {{ $attributes->merge([
    'class' =>
        'rounded-lg p-2 w-full focus:ring-2 focus:outline-none border ' .
        ($errors->has($name)
            ? 'border-red-500 focus:ring-red-400'
            : 'border-gray-300 focus:ring-gray-400')
]) }}
>
@error($name)
    <p id="{{ $name }}-error" class="text-red-600 text-sm mt-1">
        {{ $message }}
    </p>
@enderror



