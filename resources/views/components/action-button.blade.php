@props(['type'])

@php
    if($type === 'edit'){
        $classes = 'block p-3 w-24 mb-5 rounded text-white text-center bg-blue-600 hover:bg-blue-800 cursor-pointer';
    } elseif($type === 'delete'){
        $classes = 'block p-3 w-24 mb-5 rounded text-white text-center bg-red-600 hover:bg-red-800 cursor-pointer';
    }
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
