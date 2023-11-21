<div class="w-full overflow-auto">
    <table {{ $attributes->merge(['class' => 'w-full p-4 ']) }}>
        {{ $slot }}
    </table>
</div>
