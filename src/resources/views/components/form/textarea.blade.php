@props(['disabled' => false, 'value'])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'p-3 mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>{{ $value ?? null }}</textarea>