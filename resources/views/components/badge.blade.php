@props([
    'type' => 'info',
])

@php
    $styles = [
        'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
        'info'    => 'bg-blue-100 text-blue-800 border-blue-400',
        'success' => 'bg-green-100 text-green-800 border-green-400',
        'danger'  => 'bg-red-100 text-red-800 border-red-400',
    ];

    $classes = $styles[$type] ?? $styles['info'];
@endphp

<span {{ $attributes->merge(['class' => "$classes border rounded text-xs font-medium px-2.5 py-0.5 rounded-sm"]) }}>
    {{ $slot }}
</span>
