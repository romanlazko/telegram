<x-telegram::layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bot') }}
        </h2>
    </x-slot>

    <x-slot name="main">
        <x-telegram::white-block>
            <div>
                <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                    <div class="flex flex-col justify-center">
                        <div class="flex">
                            <div class="flex-col items-center my-auto">
                                <img src="{{ $bot->photo }}" alt="Avatar" class="mr-4 w-12 h-12 min-w-[48px] rounded-full">
                            </div>
                            <div class="flex-col justify-center">
                                <div class="">
                                    <a href="" class="w-full text-sm font-light text-gray-500 mb-1">{{ $bot->id ?? null }}</a>
                                    <div class="w-full text-md font-medium text-gray-900">{{ $bot->first_name ?? null }} {{ $bot->last_name ?? null }}</div>
                                    <a class="w-full text-sm font-light text-blue-500 hover:underline" href="https://t.me/{{$bot->username}}">{{ "@".($bot->username ?? null) }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col justify-center">
                        <div class="flex justify-end space-x-2">
                            <div>
                                <x-telegram::a-buttons.secondary href="{{ route('bot.show', $bot->id) }}">
                                    {{ __('Test') }}
                                </x-telegram::a-buttons.secondary>
                            </div>
                            <div>
                                <form method="post" action="{{ route('bot.destroy', $bot->id) }}" class="">
                                    @csrf
                                    @method('delete')
                                    <x-telegram::buttons.danger>
                                        {{ __('Delete') }}
                                    </x-telegram::buttons.danger>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-telegram::white-block>
        
        <x-telegram::white-block>
            <h1 class="text-xl font-bold">Webhook info:</h1>
            <div class="w-full">
                @dump($bot->webhook)
            </div>
        </x-telegram::white-block>
        <x-telegram::white-block>
            <h1 class="text-xl font-bold">Commands:</h1>
            <div class="w-full">
                @dump($bot->all_commands_list)
            </div>
        </x-telegram::white-block>
        <x-telegram::white-block>
            <h1 class="text-xl font-bold">Commands:</h1>
            <div class="w-full">
                @dump($bot->config)
            </div>
        </x-telegram::white-block>
    </x-slot>
</x-telegram::layout>