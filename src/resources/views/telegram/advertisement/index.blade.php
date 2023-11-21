<x-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Advertisements') }}
            </h2>
            <div class="flex-col">
                <x-a-buttons.secondary href="{{ route('advertisement.create') }}" class="float-right">
                    {{ __("✚Add advertisement") }}
                </x-a-buttons.secondary>
            </div>
        </div>
    </x-slot>
    <x-slot name="main">
        <x-white-block class="p-0">
            <x-search :action="route('advertisement.index')"/>
        </x-white-block>

        <x-white-block class="p-0">
            <x-table.table class="whitespace-nowrap">
                <x-table.thead>
                    <tr>
                        <x-table.th>id</x-table.th>
                        <x-table.th>Name</x-table.th>
                        <x-table.th>Views</x-table.th>
                        <x-table.th>Status</x-table.th>
                        <x-table.th></x-table.th>
                    </tr>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($advertisements as $index => $advertisement)
                        <tr class="@if($index % 2 === 0) bg-gray-100 @endif text-sm">
                            <x-table.td>{{ $advertisement->id }}</x-table.td>
                            <x-table.td>{{ $advertisement->name }}</x-table.td>
                            <x-table.td>{{ $advertisement->views }}</x-table.td>
                            <x-table.td>
                                <x-badge color="{{$advertisement->is_active ? 'green' : 'red'}}">
                                    {{$advertisement->is_active ? "Active" : "Disable"}}
                                </x-badge> 
                            </x-table.td>
                            <x-table.buttons>
                                <x-a-buttons.secondary href="{{ route('advertisement.show', $advertisement) }}">Test</x-a-buttons.secondary>
                                <x-a-buttons.primary href="{{ route('advertisement.edit', $advertisement) }}">Edit</x-a-buttons.primary>
                                <form action="{{ route('advertisement.destroy', $advertisement) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <x-buttons.danger>Delete</x-buttons.dangertton>
                                </form>
                            </x-table.buttons>
                        </tr>
                    @empty
                    @endforelse
                </x-table.tbody>
            </x-table.table>
        </x-white-block>
    </x-slot>
</x-layout>