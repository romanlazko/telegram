<x-app-layout>
    <x-slot name="header">
        <div class="sm:flex items-center sm:space-x-3 w-max">
            <div class="flex items-center">
                <div class="flex-col items-center my-auto">
                    <img src="{{ $telegram_bot->photo ?? null }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                </div>
                <div class="flex-col justify-center">
                    <div>
                        <a href="{{ route('admin.telegram_bot.show', $telegram_bot) }}" class="w-full text-sm font-light text-gray-500 mb-1 hover:underline">
                            {{ $telegram_bot->id ?? null }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('admin.telegram_bot.show', $telegram_bot) }}" class="w-full text-md font-medium text-gray-900">
                            {{ $telegram_bot->first_name ?? null }} {{ $telegram_bot->last_name ?? null }}
                        </a>
                    </div>
                    <div>
                        <a class="w-full text-sm font-light text-blue-500 hover:underline" href="https://t.me/{{$telegram_bot->username}}">
                            {{ "@".($telegram_bot->username ?? null) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <x-header.menu>
            <x-header.link href="{{ route('admin.telegram_bot.show', $telegram_bot) }}" class="float-right" :active="request()->routeIs('admin.telegram_bot.show')">
                {{ __('Bot') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.telegram_bot.chat.index', $telegram_bot ) }}" class="float-right" :active="request()->routeIs('admin.telegram_bot.chat.*')">
                {{ __('Chats') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.telegram_bot.advertisement.index', $telegram_bot) }}" class="float-right" :active="request()->routeIs('admin.telegram_bot.advertisement.*')">
                {{ __('Advertisements') }}
            </x-header.link>
            <x-header.link href="{{ route('admin.telegram_bot.edit', $telegram_bot) }}" class="float-right" :active="request()->routeIs('admin.telegram_bot.edit')">
                {{ __('Settings') }}
            </x-header.link>
        </x-header.menu>
    </x-slot>
    
    <div class="w-full space-y-6 m-auto max-w-2xl">
        <form method="post" action="{{ route('admin.telegram_bot.update', $telegram_bot) }}" class="space-y-6">
            @csrf
            @method('PUT')
            <x-white-block>
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('WebHook setup') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Use this form to specify a URL and receive incoming updates via an outgoing webhook.') }}
                    </p>
                    <hr>
                    <div>
                        <x-form.label for="token" :value="__('Token:')" />
                        <x-form.input id="token" name="token" type="text" class="mt-1 block w-full" :value="old('token', $telegram_bot->token)" required autocomplete="token" />
                        <x-form.error class="mt-2" :messages="$errors->get('token')" />
                    </div>
                </div>
            </x-white-block>
            
            <x-white-block>
                <div class="space-y-4">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Hello message') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Use this form to specify a first message after start bot.') }}
                    </p>
                    <hr>
                    <div>
                        <x-form.textarea id="ru_message" name="settings[message][ru]" type="text" class="mt-1 block w-full" :value="old('ru_message', $telegram_bot->settings->message->ru ?? null)" required autocomplete="ru_message" placeholder="RU"/>
                        <x-form.error class="mt-2" :messages="$errors->get('ru_message')" />
                    </div>
                    <div>
                        <x-form.textarea id="en_message" name="settings[message][en]" type="text" class="mt-1 block w-full" :value="old('en_message', $telegram_bot->settings->message->en ?? null)" required autocomplete="en_message"  placeholder="EN"/>
                        <x-form.error class="mt-2" :messages="$errors->get('en_message')" />
                    </div>
                    <div>
                        <x-form.textarea id="cz_message" name="settings[message][cz]" type="text" class="mt-1 block w-full" :value="old('cz_message', $telegram_bot->settings->message->cz ?? null)" required autocomplete="cz_message"  placeholder="CZ"/>
                        <x-form.error class="mt-2" :messages="$errors->get('cz_message')" />
                    </div>
                </div>
            </x-white-block>

            <div class="flex justify-end">
                <x-buttons.primary>{{ __('Save') }}</x-buttons.primary>
            </div>
        </form>
    </div>
</x-app-layout>