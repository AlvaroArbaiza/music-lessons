@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#16697a] focus:ring-[#16697a] rounded-md shadow-sm']) !!}>
