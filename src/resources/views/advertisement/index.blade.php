<x-telegram::layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Advertisements') }}
            </h2>
            <div class="flex-col">
                <x-telegram::a-buttons.secondary href="{{ route('advertisement.create') }}" class="float-right">
                    {{ __("✚Add advertisement") }}
                </x-telegram::a-buttons.secondary>
            </div>
        </div>
    </x-slot>
    <x-slot name="main">
        <x-telegram::white-block class="p-0">
            <x-telegram::search :action="route('advertisement.index')"/>
        </x-telegram::white-block>

        <x-telegram::white-block class="p-0">
            <x-telegram::table.table class="whitespace-nowrap">
                <x-telegram::table.thead>
                    <tr>
                        <x-telegram::table.th>id</x-telegram::table.th>
                        <x-telegram::table.th>Name</x-telegram::table.th>
                        <x-telegram::table.th>Views</x-telegram::table.th>
                        <x-telegram::table.th>Status</x-telegram::table.th>
                        <x-telegram::table.th></x-telegram::table.th>
                    </tr>
                </x-telegram::table.thead>
                <x-telegram::table.tbody>
                    @forelse ($advertisements as $index => $advertisement)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif text-sm">
                            <x-telegram::table.td>{{ $advertisement->id }}</x-telegram::table.td>
                            <x-telegram::table.td>{{ $advertisement->name }}</x-telegram::table.td>
                            <x-telegram::table.td>{{ $advertisement->views }}</x-telegram::table.td>
                            <x-telegram::table.td>
                                <x-telegram::badge color="{{$advertisement->is_active ? 'green' : 'red'}}">
                                    {{$advertisement->is_active ? "Active" : "Disable"}}
                                </x-telegram::badge> 
                            </x-telegram::table.td>
                            <x-telegram::table.buttons>
                                <x-telegram::a-buttons.secondary href="{{ route('advertisement.show', $advertisement) }}">Test</x-telegram::a-buttons.secondary>
                                <x-telegram::a-buttons.primary href="{{ route('advertisement.edit', $advertisement) }}">Edit</x-telegram::a-buttons.primary>
                                <form action="{{ route('advertisement.destroy', $advertisement) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <x-telegram::buttons.danger>Delete</x-telegram::buttons.dangertton>
                                </form>
                            </x-telegram::table.buttons>
                        </tr>
                    @empty
                    @endforelse
                </x-telegram::table.tbody>
            </x-telegram::table.table>
        </x-telegram::white-block>
    </x-slot>
</x-telegram::layout>