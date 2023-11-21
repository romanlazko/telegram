<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bots:') }}
        </h2>
        <div class="space-x-4 sm:-my-px sm:ml-10 flex">
            <x-a-buttons.secondary href="{{ route('admin.telegram_bot.create') }}" class="float-right" title="Create new bot">
                {{ __("✚") }}
            </x-a-buttons.secondary>
        </div>
    </x-slot>

    @forelse ($telegram_bots as $telegram_bot)
        <x-white-block class="p-4">
            <div class="w-full flex justify-between">
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
                <div class="flex items-center space-x-2">
                    <x-buttons.delete action="{{ route('admin.telegram_bot.destroy', $telegram_bot) }}">
                        {{ __('Delete') }}
                    </x-buttons.delete>
                </div>
            </div>
        </x-white-block>
    @empty
        
    @endforelse
</x-app-layout>