@props(['disabled' => false, 'checked' => null])

<input {{ $disabled ? 'disabled' : '' }} {{ $checked ? 'checked' : '' }} type="checkbox" {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}">