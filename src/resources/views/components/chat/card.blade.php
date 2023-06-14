<div class="flex items-center">
    <a href="{{ route('chat.show', $chat) }}">
        <div class="flex-col items-center my-auto">
            <img src="{{ $chat->photo }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
        </div>
        <div class="flex-col justify-center">
            <div class="">
                <a href="{{ route('chat.show', $chat) }}" class="w-full text-sm font-light text-gray-500 mb-1 hover:underline">{{ $chat->chat_id ?? null }}</a>
                <div class="w-full text-md font-medium text-gray-900">{{ $chat->first_name ?? null }} {{ $chat->last_name ?? null }}</div>
                @if ($chat->username)
                    <a class="w-full text-sm font-light text-blue-500 hover:underline" href="https://t.me/{{$chat->username}}">{{ "@".($chat->username ?? null) }}</a>
                @else
                    <a class="w-full text-sm font-light text-blue-500 hover:underline" href="{{ route('get-contact', $chat) }}">{{ __('@'.$chat->first_name.$chat->last_name) }}</a>
                @endif
            </div>
        </div>
        {{ $slot ?? null}}
    </a>
</div>