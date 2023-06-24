<x-telegram::layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bot') }}
            </h2>
            <div class="flex-col">
                <x-telegram::a-buttons.secondary href="{{ route('bot.create') }}" class="float-right">
                    {{ __("✚Create bot") }}
                </x-telegram::a-buttons.secondary>
            </div>
        </div>
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
        
        <h1 class="text-xl font-bold">Webhook info:</h1>
        <x-telegram::white-block>
            <div class="w-full">
                @dump($bot->webhook)
            </div>
        </x-telegram::white-block>

        <h1 class="text-xl font-bold">Commands:</h1>
        <x-telegram::white-block>
            <div class="w-full">
                @dump($bot->all_commands_list)
            </div>
        </x-telegram::white-block>

        <h1 class="text-xl font-bold">Config:</h1>
        <x-telegram::white-block>
            <div class="w-full">
                @dump($bot->config)
            </div>
        </x-telegram::white-block>

        <h1 class="text-xl font-bold">Logs:</h1>
        <x-telegram::white-block class="p-0">
            <x-telegram::table.table>
                <x-telegram::table.thead>
                    <tr>
                        <x-telegram::table.th>id</x-telegram::table.th>
                        <x-telegram::table.th>Message</x-telegram::table.th>
                        <x-telegram::table.th>Code</x-telegram::table.th>
                        <x-telegram::table.th>Params</x-telegram::table.th>
                        <x-telegram::table.th>Trace</x-telegram::table.th>
                        <x-telegram::table.th>Created<br>Updated</x-telegram::table.th>
                    </tr>
                </x-telegram::table.thead>
                <x-telegram::table.tbody>
                    @forelse ($bot->logs as $index => $log)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif text-sm">
                            <x-telegram::table.td>{{ $log->id }}</x-telegram::table.td>
                            <x-telegram::table.td class="whitespace-nowrap">
                                <p class="text-red-700">{{ $log->message }}</p>
                                <p>{{ dirname(Str::after($log->file, 'public_html')) }}/<b>{{ basename($log->file) }}</b></p>
                                <p class="text-blue-700 font-bold">{{ $log->line }}</p>
                            </x-telegram::table.td>
                            <x-telegram::table.td>{{ $log->code }}</x-telegram::table.td>
                            <x-telegram::table.td>
                                <pre>{{ json_encode(json_decode($log->params), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); }}</pre>
                            </x-telegram::table.td>
                            <x-telegram::table.td class="whitespace-nowrap">
                                <p onclick='alert({{ json_encode(str_replace("#", "\n#", $log->trace), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }})'>
                                    {{ Str::limit($log->trace, 100, '...') }}
                                </p>
                                
                            </x-telegram::table.td>
                            <x-telegram::table.td class="text-xs">
                                <p title="{{ $log->created_at->format('d.m.Y (H:i)') }}">
                                    {{ $log->created_at->diffForHumans() }}
                                </p>
                                <p title="{{ $log->updated_at->format('d.m.Y (H:i)') }}">
                                    {{ $log->updated_at->diffForHumans() }}
                                </p>
                            </x-telegram::table.td>
                        </tr>
                    @empty
                    @endforelse
                </x-telegram::table.tbody>
            </x-telegram::table.table>
        </x-telegram::white-block>
    </x-slot>
</x-telegram::layout>