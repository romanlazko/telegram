<div {{ $attributes->merge(['class' => 'bg-white shadow sm:rounded-lg w-full overflow-auto ' . ($attributes->get('class') ?? 'p-4 sm:p-8')]) }}>
    {{ $slot }}
</div>

