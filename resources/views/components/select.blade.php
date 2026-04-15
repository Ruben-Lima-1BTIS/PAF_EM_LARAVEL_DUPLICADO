@props([
'name',
'label' => null,
'required' => false,
'options' => [],
'selected' => null,
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
        'class' => 'border border-gray-300 rounded-lg p-2 w-full mb-4 focus:outline-none focus:ring-2 focus:ring-slate-500'
    ]) }}>
    <option value="">Select an option</option>

    @foreach($options as $option)
    <option value="{{ $option['id'] }}" {{ $selected == $option['id'] ? 'selected' : '' }}>
        {{ $option['name'] }}
    </option>
    @endforeach
</select>

@error($name)
<p class="text-red-600 text-sm mt-1">{{ $message }}</p>
@enderror