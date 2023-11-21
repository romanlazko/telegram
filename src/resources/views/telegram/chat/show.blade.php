<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <div class="flex items-center">
                <div class="flex-col items-center my-auto">
                    <img src="{{ $chat->photo ?? null }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                </div>
                <div class="flex-col justify-center">
                    <div>
                        <a href="{{ route('admin.telegram_bot.chat.show', [$telegram_bot, $chat]) }}" class="w-full text-sm font-light text-gray-500 mb-1 hover:underline">
                            {{ $chat->chat_id ?? null }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('admin.telegram_bot.chat.show', [$telegram_bot, $chat]) }}" class="w-full text-md font-medium text-gray-900">
                            {{ $chat->first_name ?? null }} {{ $chat->last_name ?? null }}
                        </a>
                    </div>
                    <div>
                        @if ($chat->username)
                            <a class="w-full text-sm font-light text-blue-500 hover:underline" href="https://t.me/{{$chat->username}}">{{ "@".($chat->username ?? null) }}</a>
                        @else
                            <a class="w-full text-sm font-light text-blue-500 hover:underline" href="{{ route('get-contact', $chat) }}">{{ __('@'.$chat->first_name.$chat->last_name) }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <x-header.menu>
            <x-header.link href="{{ route('admin.telegram_bot.chat.index', $telegram_bot) }}" class="float-right">
                {{ __('← Chats') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.telegram_bot.chat.show', [$telegram_bot, $chat]) }}" class="float-right" :active="request()->routeIs('admin.telegram_bot.chat.show')">
                {{ __('Chat') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.telegram_bot.chat.edit', [$telegram_bot, $chat]) }}" class="float-right" :active="request()->routeIs('admin.telegram_bot.chat.edit')">
                {{ __('Settings') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    
    <div class="space-y-6">
        <div class=" bg-gray-200 space-y-6">
            @foreach ($messages->reverse() as $message)
                @if ($message->user?->is_bot === 0 OR $message->callback_query?->user?->is_bot === 0 OR $message->sender_chat)
                    <x-message.block class="mr-6 ml-1">
                        @if ($message->photo)
                            <x-message.img class="rounded-md" :src=" $message->photo "/>
                        @endif
                        <x-message.text :message="$message" class="bg-white"/>
                        <x-message.buttons :message="$message"/>
                    </x-message.block>
                @else
                    <x-message.block class="sm:ml-auto ml-6 mr-1">
                        @if ($message->photo)
                            <x-message.img class="rounded-md" :src=" $message->photo "/>
                        @endif

                        <x-message.text :message="$message" class="bg-blue-50"/>
                        <x-message.buttons :message="$message"/>
                    </x-message.block>
                @endif
            @endforeach
        </div>
    </div>

    <x-slot name='footer'>
        <div class="w-full p-2 space-y-2">
            <div class="">
                {{$messages->links()}}
            </div>
            <x-message.send :action="route('admin.telegram_bot.message.store', [$telegram_bot, $chat])"/>
        </div>
    </x-slot>
</x-app-layout>