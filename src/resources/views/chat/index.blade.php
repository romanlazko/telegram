<x-telegram::layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chats') }}
        </h2>
    </x-slot>

    <x-slot name="main">
        <x-telegram::white-block class="p-0">
            <x-telegram::search :action="route('chat.index')"/>
        </x-telegram::white-block>
        <x-telegram::white-block class="p-0">
            <x-telegram::table.table class="whitespace-nowrap">
                <x-telegram::table.thead class="text-left py-2 ">
                    <tr>
                        <x-telegram::table.th>id</x-telegram::table.th>
                        <x-telegram::table.th>Chat</x-telegram::table.th>
                        <x-telegram::table.th>Role</x-telegram::table.th>
                        <x-telegram::table.th>Last message</x-telegram::table.th>
                        <x-telegram::table.th>Referal</x-telegram::table.th>
                        <x-telegram::table.th>Manager</x-telegram::table.th>
                        <x-telegram::table.th>Created<br>Updated</x-telegram::table.th>
                    </tr>
                </x-telegram::table.thead>
                <x-telegram::table.tbody>
                    @forelse ($chats_collection as $index => $chat)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif text-sm">
                            <x-telegram::table.td>{{ $chat->id }}</x-telegram::table.td>
                            <x-telegram::table.td class="whitespace-nowrap">
                                <x-telegram::chat.card :chat="$chat"/>
                            </x-telegram::table.td>
                            <x-telegram::table.td>
                                <x-telegram::badge color="green">
                                    {{ $chat->role }}
                                </x-telegram::badge>
                            </x-telegram::table.td>
                            <x-telegram::table.td>
                                <a class="w-full text-sm font-light hover:underline text-gray-500" href="{{ route('message.index', $chat) }}">
                                    {{ $chat->last_message }}
                                </a>
                            </x-telegram::table.td>
                            <x-telegram::table.td>{{ $chat->referal_id }}</x-telegram::table.td>
                            <x-telegram::table.td>{{ $chat->manager_id }}</x-telegram::table.td>
                            <x-telegram::table.td class="text-xs">
                                <p title="{{ $chat->created_at->format('d.m.Y (H:i)') }}">
                                    {{ $chat->created_at->diffForHumans() }}
                                </p>
                                <p title="{{ $chat->updated_at->format('d.m.Y (H:i)') }}">
                                    {{ $chat->updated_at->diffForHumans() }}
                                </p>
                            </x-telegram::table.td>
                        </tr>
                    @empty
                        <tr>
                            <x-telegram::table.td></x-telegram::table.td>
                            <x-telegram::table.td>Nothing found</x-telegram::table.td>
                        </tr>
                    @endforelse
                </x-telegram::table.tbody>
            </x-telegram::table.table>
            
        </x-telegram::white-block>
        <div>
            {{$chats->links()}}
        </div>
    </x-slot>
</x-telegram::layout>