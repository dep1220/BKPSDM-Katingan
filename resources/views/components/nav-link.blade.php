@props(['active'])

@php
// Hanya berikan minimal styling, biarkan class dari parent yang menentukan tampilan
$classes = 'inline-flex items-center transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
