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
    <div class="space-y-6">
        <h1 class="text-xl font-bold">Webhook info:</h1>
        <x-white-block>
            <div class="w-full relative z-0">
                @dump($telegram_bot->webhook)
            </div>
        </x-white-block>
    
        <h1 class="text-xl font-bold">Commands:</h1>
        <x-white-block>
            <div class="w-full relative z-0">
                @dump($telegram_bot->all_commands_list)
            </div>
        </x-white-block>
    
        <h1 class="text-xl font-bold">Config:</h1>
        <x-white-block>
            <div class="w-full relative z-0">
                @dump($telegram_bot->config)
            </div>
        </x-white-block>
    
        <h1 class="text-xl font-bold">Logs:</h1>
        <x-white-block class="p-0">
            <x-table.table>
                <x-table.thead>
                    <tr>
                        <x-table.th>id</x-table.th>
                        <x-table.th>Message</x-table.th>
                        <x-table.th>Code</x-table.th>
                        <x-table.th>Params</x-table.th>
                        <x-table.th>Trace</x-table.th>
                        <x-table.th>Created<br>Updated</x-table.th>
                    </tr>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($telegram_bot->logs as $index => $log)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif text-sm">
                            <x-table.td>{{ $log->id }}</x-table.td>
                            <x-table.td class="whitespace-nowrap">
                                <p class="text-red-700">{{ $log->message }}</p>
                                <p>{{ dirname(Str::after($log->file, 'public_html')) }}/<b>{{ basename($log->file) }}</b></p>
                                <p class="text-blue-700 font-bold">{{ $log->line }}</p>
                            </x-table.td>
                            <x-table.td>{{ $log->code }}</x-table.td>
                            <x-table.td>
                                <pre>{{ json_encode(json_decode($log->params), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); }}</pre>
                            </x-table.td>
                            <x-table.td class="whitespace-nowrap">
                                <p onclick='alert({{ json_encode(str_replace("#", "\n#", $log->trace), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }})'>
                                    {{ Str::limit($log->trace, 100, '...') }}
                                </p>
                                
                            </x-table.td>
                            <x-table.td class="text-xs">
                                <p title="{{ $log->created_at->format('d.m.Y (H:i)') }}">
                                    {{ $log->created_at->diffForHumans() }}
                                </p>
                                <p title="{{ $log->updated_at->format('d.m.Y (H:i)') }}">
                                    {{ $log->updated_at->diffForHumans() }}
                                </p>
                            </x-table.td>
                        </tr>
                    @empty
                    @endforelse
                </x-table.tbody>
            </x-table.table>
        </x-white-block>
    </div>
</x-app-layout>