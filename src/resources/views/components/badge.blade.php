@props(['tag', 'color' => "", 'trigger'])

@if ((isset($trigger) AND $trigger == true) OR !isset($trigger))
    @if ($active) 
        @php
            $color = "green";
        @endphp
    @endif
    <span {{ $attributes->merge(['class' => "border-2 border-collapse border-".$color."-500 rounded-lg text-center items-center text-sm bg-".$color."-100 hover:bg-".$color."-200 text-".$color."-800 inline-block max-w-max px-2 items-center justify-center"]) }}>
        {{ $slot }}
    </span>
@endif
