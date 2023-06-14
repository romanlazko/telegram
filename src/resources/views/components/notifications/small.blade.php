@props(['title', 'ok' => null])

<div x-data="{ show: false }" x-init="setTimeout(() => show = true, 1000); setTimeout(() => show = false, 5000)" class="max-w-[2/3]">
    <div {{ $attributes->merge(['class' => 'fixed bottom-0 right-0 mb-4 mr-4 text-white px-4 py-2 rounded shadow-lg max-w-[2/3]']) }} 
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-2"
    >
    {{ $title }}
    </div>
</div>