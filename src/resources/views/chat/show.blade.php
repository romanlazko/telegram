<x-telegram::layout>
    <x-slot name="header">
        <x-telegram::chat.card :chat="$chat">
            <form method="POST" action="{{ route('chat.update', $chat->id) }}" class="m-0 mx-2">
                @csrf
                @method('PUT')
                <x-telegram::badge color="green" class="h-min">
                    <select class="appearance-none bg-transparent p-0 pr-3 bg-no-repeat bg-right border-none text-xs" onchange="this.form.submit()" name="role">
                        <option @selected($chat->role === 'user') value="user">user</option>
                        <option @selected($chat->role === 'admin') value="admin">admin</option>
                        <option @selected($chat->role === 'blocked') value="blocked">blocked</option>
                    </select>
                </x-telegram::badge>
            </form>
            <x-telegram::a-buttons.secondary href="{{ route('message.index', $chat) }}">
                💬 Messages
            </x-telegram::a-buttons.secondary>
        </x-telegram::chat.card>
    </x-slot>

    <x-slot name="main">
        
    </x-slot>
</x-telegram::layout>