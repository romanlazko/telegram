<x-dropdown align="left" width="w-full">
    <x-slot name="trigger">
        <x-responsive-nav-link>
            <button class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->bot?->username ??  __('Create bot')}}</div>

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-responsive-nav-link>
    </x-slot>

    <x-slot name="content">
        @foreach (auth()->user()->bots()->get() as $bot)
            <x-responsive-nav-link :href="route('switch-account', $bot)" :active="true" class="w-full">
                {{ $bot->username }}
            </x-responsive-nav-link>
        @endforeach
    </x-slot>
</x-dropdown>

<x-responsive-nav-link :href="route('chat.index')" :active="request()->routeIs('chat')">
    {{ __('Chats') }}
</x-responsive-nav-link>
<x-responsive-nav-link :href="route('advertisement.index')" :active="request()->routeIs('advertisement')">
    {{ __('Advertisement') }}
</x-responsive-nav-link>
<x-telegram::bot-responsive-nav-links/>