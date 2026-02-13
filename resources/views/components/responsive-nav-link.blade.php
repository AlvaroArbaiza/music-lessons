@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 text-left text-base font-medium focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out';

$activeStyle = ($active ?? false)
            ? 'border-color: #16697a; color: #16697a; background-color: #d8f0f5;'
            : 'color: #5a6c7d;';
@endphp

<a {{ $attributes->merge(['class' => $classes, 'style' => $activeStyle]) }} @if(!($active ?? false)) onmouseover="this.style.color='#16697a'" onmouseout="this.style.color='#5a6c7d'" @endif>
    {{ $slot }}
</a>
