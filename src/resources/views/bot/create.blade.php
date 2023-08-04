<x-telegram::layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create bot') }}
        </h2>
    </x-slot>
    <x-slot name="main">
        <x-telegram::white-block>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('WebHook setup') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Use this form to specify a URL and receive incoming updates via an outgoing webhook.') }}
            </p>
            <form method="post" action="{{ route('bot.store') }}" class="space-y-6">
                @csrf
        
                <div>
                    <x-telegram::form.label for="url" :value="__('Url')" />
                    <x-telegram::form.input id="url" name="url" type="text" class="mt-1 block w-full" required autofocus autocomplete="url" :value="url('/api/telegram')" />
                    <x-telegram::form.error class="mt-2" :messages="$errors->get('url')" />
                </div>

                <div>
                    <x-telegram::form.label for="telegram_chat_id" :value="__('Owner (chat_id):')" />
                    <x-telegram::form.input id="telegram_chat_id" name="telegram_chat_id" type="text" class="mt-1 block w-full" :value="old('telegram_chat_id', auth()->user()->telegram_chat_id)" required autocomplete="telegram_chat_id" />
                    <x-telegram::form.error class="mt-2" :messages="$errors->get('telegram_chat_id')" />
                </div>
        
                <div>
                    <x-telegram::form.label for="token" :value="__('token')" />
                    <x-telegram::form.input id="token" name="token" type="text" class="mt-1 block w-full" :value="old('token')" required autocomplete="token" />
                    <x-telegram::form.error class="mt-2" :messages="$errors->get('token')" />
                </div>
        
                <div class="flex items-center gap-4">
                    <x-telegram::buttons.primary>{{ __('Create') }}</x-telegram::buttons.primary>
                </div>
            </form>
        </x-telegram::white-block>
    </x-slot>
</x-telegram::layout>