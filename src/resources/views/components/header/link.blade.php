@props(['active'])

@php
    $activeClasses = ($active ?? false)
        ? ' border-indigo-400 text-left text-indigo-700 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700'
        : ' border-transparent text-gray-500 hover:text-gray-800 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:border-gray-300';
@endphp

<a {{ $attributes->merge(['class' => 'block w-full border-l-4 sm:border-l-0 sm:border-b-2 px-2 sm:px-0 py-2 text-left text-base font-base transition duration-150 ease-in-out' . $activeClasses]) }}>
    <div class="flex whitespace-nowrap">
        {{ $slot }}
    </div>
</a>