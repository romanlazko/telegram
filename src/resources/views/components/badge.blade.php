@props(['tag', 'color' => "", 'trigger', 'customColor' => null])

@if ((isset($trigger) AND $trigger == true) OR !isset($trigger))
    <span {{ $attributes->merge([
        'class' => "border-2 border-collapse @if($customColor) border-[{$customColor}] @else border-{$color}-600 @endif rounded-lg text-center items-center text-sm  @if($customColor) bg-[{$customColor}] @else bg-{$color}-600 @endif text-white  @endif  inline-block max-w-max px-2 items-center justify-center"
    ]) }}>
        {{ $slot }}
    </span>
@endif
