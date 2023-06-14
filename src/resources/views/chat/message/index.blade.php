<x-telegram::layout>
    <x-slot name="header">
        <x-telegram::chat.card :chat="$chat"/>
    </x-slot>

    <x-slot name="main">
        <x-telegram::white-block class="p-0">
            <x-telegram::search :action="route('message.index', $chat)"/>
        </x-telegram::white-block>

        @foreach ($messages->reverse() as $message)
            @if ($message->user?->is_bot === 0 OR $message->callback_query?->user?->is_bot === 0 OR $message->sender_chat)
                <x-telegram::message.block class="mr-6 ml-1">
                    @if ($message->photo)
                        <x-telegram::message.img class="rounded-md" :src=" $message->photo "/>
                    @endif
                    <x-telegram::message.text :message="$message" class="bg-white"/>
                    <x-telegram::message.buttons :message="$message"/>
                </x-telegram::message.block>
            @else
                <x-telegram::message.block class="sm:ml-auto ml-6 mr-1">
                    @if ($message->photo)
                        <x-telegram::message.img class="rounded-md" :src=" $message->photo "/>
                    @endif

                    <x-telegram::message.text :message="$message" class="bg-blue-50"/>
                    <x-telegram::message.buttons :message="$message"/>
                </x-telegram::message.block>
            @endif
        @endforeach

        <x-telegram::white-block class="p-0">
            <x-telegram::message.send :action="route('message.store', $chat)"/>
        </x-telegram::white-block>

        <div>
            {{$messages->links()}}
        </div>
    </x-slot>
</x-telegram::layout>