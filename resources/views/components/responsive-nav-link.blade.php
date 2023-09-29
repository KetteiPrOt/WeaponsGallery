@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 text-left text-base font-medium text-white focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 text-left text-base font-medium text-gray-300/75 hover:text-gray-300 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
