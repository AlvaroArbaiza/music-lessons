@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out';

$activeStyle = ($active ?? false)
            ? 'border-color: #16697a; color: #16697a;'
            : 'color: #5a6c7d;';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'style' => $activeStyle]) }} @if(!($active ?? false)) onmouseover="this.style.color='#16697a'" onmouseout="this.style.color='#5a6c7d'" @endif>
    {{ $slot }}
</a>
