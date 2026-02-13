@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm', 'style' => 'color: #2c3e50;']) }}>
    {{ $value ?? $slot }}
</label>
