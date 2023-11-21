@props(['disabled' => false])

<input type="color" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-12 h-12']) !!}">