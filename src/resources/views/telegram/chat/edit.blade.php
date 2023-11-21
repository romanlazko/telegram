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
    
    <div class="w-full space-y-6 m-auto max-w-2xl">
        <form method="post" action="{{ route('admin.telegram_bot.chat.update', [$telegram_bot, $chat]) }}" class="space-y-6">
            @csrf
            @method('PUT')
            <x-white-block>
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Chat settings') }}
                    </h2>
                    <hr>
                    <div>
                        <x-form.label for="role" :value="__('Role:')" />
                        <x-form.select id="role" name="role" class="mt-1 block w-full" required>
                            <option @selected($chat->role == 'admin') value="admin">Admin</option>
                            <option @selected($chat->role == 'user') value="user">User</option>
                            <option @selected($chat->role == 'blocked') value="blocked">Blocked</option>
                        </x-form.select>
                        <x-form.error class="mt-2" :messages="$errors->get('role')" />
                    </div>
                </div>
            </x-white-block>

            <div class="flex justify-end">
                <x-buttons.primary>{{ __('Save') }}</x-buttons.primary>
            </div>
        </form>
    </div>
</x-app-layout>