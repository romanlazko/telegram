<x-dropdown align="left" width="w-full">
    <x-slot name="trigger">
        <x-responsive-nav-link>
            <button class="inline-flex items-center ">
                <div>{{ request()->user()->bot?->username ??  __("Choose bot")}}</div>

                <div class="ml-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-responsive-nav-link>
    </x-slot>

    <x-slot name="content">
        @forelse (request()->user()->bots()->get() as $bot)
            <form action="{{ route('bot.switch', $bot) }}" method="post" id="{{ $bot->username }}">
                @csrf
                @method('POST')
                <x-responsive-nav-link :active="request()->user()->bot?->id === $bot?->id" onclick="document.getElementById('{{ $bot?->username }}').submit()">
                    {{ $bot?->username }}
                </x-responsive-nav-link>
            </form>
        @empty
            <x-dropdown-link :active="route('bot.create')" :href="route('bot.create')">
                {{ __("+Create bot") }}
            </x-dropdown-link>
        @endforelse
    </x-slot>
</x-dropdown>

<x-responsive-nav-link :href="route('chat.index')" :active="request()->routeIs('chat')">
    {{ __('Chats') }}
</x-responsive-nav-link>
<x-responsive-nav-link :href="route('advertisement.index')" :active="request()->routeIs('advertisement')">
    {{ __('Advertisement') }}
</x-responsive-nav-link>
<x-telegram::bot-responsive-nav-links/>