@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block w-full py-3 pl-5 bg-indigo-900'
                : 'block w-full py-3 pl-5 hover:bg-indigo-900';
@endphp

<li class="w-full">
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
