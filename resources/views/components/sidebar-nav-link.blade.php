@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-lg md:text-sm w-full text-gray-100 bg-blue-600'
            : 'flex items-center px-4 py-3 text-lg md:text-sm w-full transition duration-300 ease-in-out hover:bg-blue-600 hover:text-gray-100 text-gray-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $icon }}
    <span>{{ $slot }}</span>
</a>