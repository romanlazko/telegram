<div class="flex flex-col">
    <div {{ $attributes->merge(['class' => 'max-w-xl']) }}">
        {{$slot}}
    </div>
</div>