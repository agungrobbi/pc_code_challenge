@props([
    'color' => 'primary',
    'style_override' => null,
    'size' => 'md'
])

@php
    // color classes
    $colorClasses = [
        'primary' => 'bg-blue-600 hover:bg-blue-700 text-white',
        'secondary' => 'bg-gray-600 hover:bg-gray-700 text-white',
        'success' => 'bg-green-600 hover:bg-green-700 text-white',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
        'warning' => 'bg-yellow-500 hover:bg-yellow-600 text-white',
        'info' => 'bg-cyan-500 hover:bg-cyan-600 text-white',
        'light' => 'bg-gray-100 hover:bg-gray-200 text-gray-800',
        'dark' => 'bg-gray-800 hover:bg-gray-900 text-white',
    ];

    // size classes
    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-6 py-3 text-lg',
    ];

    // Base classes that apply to all buttons
    $baseClasses = 'rounded font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2';

    // Determine which classes to use
    $buttonClasses = $style_override ?? ($colorClasses[$color] ?? $colorClasses['primary']);
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<button {{ $attributes->merge([
    'type' => 'button',
    'class' => "$baseClasses $sizeClass $buttonClasses"
]) }}>
    {{ $slot }}
</button>
