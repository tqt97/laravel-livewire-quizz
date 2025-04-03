@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium font-semibold text-sm text-gray-900']) }}>
    {{ $value ?? $slot }}
</label>