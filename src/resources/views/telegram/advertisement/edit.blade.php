<x-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit advertisement') }}
            </h2>
            <div class="flex-col space-x-2">
                <div class="flex space-x-2 items-center">
                    <div class="flex-col">
                        <x-a-buttons.secondary href="{{ route('advertisement.index') }}" >
                            {{ __("←Back") }}
                        </x-a-buttons.secondary>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    
    <x-slot name="main">
        <div class="sm:flex grid sm:grid-cols-2 grid-cols-1 sm:space-x-2 justify-between sm:space-y-0 space-y-6">
            <div class="flex-col max-w-xl w-full sm:w-1/2 h-min">
                <x-white-block>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Update advertisement') }}
                    </h2>
            
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Use this form to update advertisement.') }}
                    </p>
                    <form method="post" action="{{ route('advertisement.update', $advertisement) }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div>
                            <x-form.label for="name" :value="__('Name:*')" />
                            <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $advertisement->name)" required autofocus autocomplete="name" placeholder="Write name. User invisible"/>
                            <x-form.error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-form.label :value="__('Images:')" />
                            <input id="images" type="file" name="images[]" multiple="multiple" accept="image/*" max="{{ 9-$advertisement->images->count() }}" class="mt-1 block w-full">
                            <div class="flex">
                                @foreach ($advertisement->images as $image)
                                    <div class="flex-col sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-1 imagePreview">
                                        <img src="{{ asset($image->url) }}" class="h-40 object-cover object-center">
                                        <div class="flex items-center mt-2">
                                            <label for="image-{{ $image->id }}" class="cursor-pointer text-blue-600 hover:underline mr-2">Delete</label>
                                            <input id="image-{{ $image->id }}" type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="imageCheckbox">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <x-form.error class="mt-2" :messages="$errors->get('images')" />
                        </div>

                        <div>
                            <x-form.label for="title" :value="__('Title:*')" />
                            <x-form.input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $advertisement->title)" required autocomplete="title" placeholder="Write title. User visible"/>
                            <x-form.error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-form.label for="description" :value="__('Description:*')" />
                            <x-form.textarea id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description', $advertisement->description)" required autocomplete="description" rows="10" placeholder="Write description in MARKDOWN format. User visible"/>
                            <x-form.error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-form.label for="command" :value="__('Command:')" />
                            <x-form.input id="command" name="command" type="text" class="mt-1 block w-full" :value="old('command', $advertisement->command)" autocomplete="command" list="bot_commands_list" placeholder="Write command"/>
                            <datalist id="bot_commands_list">
                                <x-bot-commands-list/>
                            </datalist>
                            <x-form.error class="mt-2" :messages="$errors->get('command')" />
                        </div>

                        <div>
                            <x-form.label for="web_page_preview" class="flex justify-start items-center">
                                <input name="web_page_preview" class="hidden" value="1"/>
                                <x-form.input id="web_page_preview" name="web_page_preview" type="checkbox" class="mx-3 show-info" value="0" :checked="!$advertisement->web_page_preview ? true : false"/>
                                {{__('Web page preview:')}}
                            </x-form.label>
                        </div>
                        <div>
                            <x-form.label for="is_active" class="flex justify-start items-center">
                                <input name="is_active" class="hidden" value="0"/>
                                <x-form.input id="is_active" name="is_active" type="checkbox" class="mx-3 show-info" value="1" :checked="$advertisement->is_active ? true : false"/>
                                {{__('Is active')}}
                            </x-form.label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-buttons.primary>{{ __('Update') }}</x-buttons.primary>
                        </div>
                    </form>
                </x-white-block>
            </div>
            {{-- <div class="flex-col max-w-xl w-full sm:w-1/2 h-min">
                <x-white-block class="p-0">
                    <table class="w-full p-4">
                        <thead class="text-left py-2">
                            <tr>
                                <th class="py-2 px-3 border-r-2 border-gray-50 w-5">id</th>
                                <th class="py-2 px-3 border-r-2 border-gray-50 w-5">Chat id</th>
                                <th class="py-2 px-3 border-r-2 border-gray-50 w-5">Delivered</th>
                                <th class="py-2 px-3 border-r-2 border-gray-50 w-5">Errors</th>
                                <th class="py-2 px-3 border-r-2 border-gray-50 w-5">Status</th>
                                <th class="py-2 px-3 border-r-2 border-gray-50 w-5"></th>
                            </tr>
                        </thead>
                        <tbody class="text-left space-y-2">
                            @forelse ($deliveries as $index => $delivery)
                                <tr class="@if($index % 2 === 0) bg-gray-100 @endif text-sm">
                                    <td class="px-3 border-r-2 border-gray-50 w-min">{{ $delivery->id }}</td>
                                    <td class="px-3 border-r-2 border-gray-50 w-min">{{ $delivery->chat_id }}</td>
                                    <td class="px-3 border-r-2 border-gray-50 w-min">{{ $delivery->ok }}</td>
                                    <td class="px-3 border-r-2 border-gray-50 w-min @if(!$delivery->ok) text-red-500 @endif">{{ $delivery->description }}</td>
                                    <td class="px-3 border-transparent border-r-2 border-gray-50 text-xs">
                                        {{ $delivery->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <x-table.table>
                        <x-table.thead>
                            <tr>
                                <x-table.th>Package id</x-table.th>
                                <x-table.th>Chats</x-table.th>
                                <x-table.th>Results</x-table.th>
                                <x-table.th>Created<br>Updated</x-table.th>
                                <x-table.th></x-table.th>
                            </tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @forelse ($distributions as $index => $distribution)
                                <tr class="@if($index % 2 === 0) bg-gray-100 @endif text-sm">
                                    <x-table.td>{{ $distribution->id }}</x-table.td>
                                    <x-table.td>
                                        <div x-data="{isOpen: false}" x-cloak>
                                            <div class="fixed inset-0 overflow-y-auto" x-show="isOpen" >
                                                <div class="flex items-center justify-center min-h-screen">
                                                    <div class="bg-white rounded-lg p-2 sm:p-6 mx-auto shadow-lg max-w-lg inset-1 w-full sm:w-2/3 h-full">
                                                        @forelse ($distribution->chat_ids as $chat_id)
                                                            <x-badge class="w-full m-1">
                                                                {{ $chat_id }}
                                                            </x-badge>
                                                        @empty
                                                        @endforelse
                                                        <x-a-buttons.danger @click="isOpen = false">╳</x-a-buttons.danger>
                                                    </div>
                                                </div>
                                            </div>
                                            <div @click="isOpen = true" class="w-full flex space-x-1 items-center">
                                                Chats:
                                                <x-badge>
                                                    {{ $distribution->chats_count }}
                                                </x-badge>
                                            </div> 
                                        </div>
                                    </x-table.td>
                                    <x-table.td>
                                        <div x-data="{isOpen: false}" x-cloak>
                                            <div class="fixed inset-0 overflow-y-auto" x-show="isOpen" >
                                                <div class="flex items-center justify-center min-h-screen">
                                                    <div class="bg-white rounded-lg p-2 sm:p-6 mx-auto shadow-lg max-w-lg inset-1 w-full sm:w-2/3 h-full">
                                                        @forelse ($distribution->results as $chat_id => $result)
                                                            <div class="w-full space-y-2 flex">
                                                                <p>{{ $chat_id }}: => 
                                                                    @if ($result->ok)
                                                                        <x-badge color="green">
                                                                            true
                                                                        </x-badge>
                                                                    @else
                                                                        <x-badge color="red" class="w-full m-1">
                                                                            {{ $result->description }}
                                                                        </x-badge>
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        @empty
                                                            
                                                        @endforelse
                                                        
                                                        <x-a-buttons.danger @click="isOpen = false">╳</x-a-buttons.danger>
                                                    </div>
                                                </div>
                                            </div>
                                            <div @click="isOpen = true" class="w-full flex space-x-1 items-center">
                                                Results:
                                                <x-badge class="w-full flex space-x-1">
                                                    <p class="text-green-500">{{ $distribution->ok_count }}</p>:
                                                    <p class="text-red-500">{{ $distribution->false_count }}</p>
                                                </x-badge>
                                            </div> 
                                        </div>
                                    </x-table.td>
                                    <x-table.td class="text-xs">
                                        {{ $distribution->created_at->diffForHumans() }}
                                        <br>
                                        {{ $distribution->updated_at->diffForHumans() }}
                                    </x-table.td>
                                    <x-table.td class="text-xs">
                                        @if ($distribution->status === 'new')
                                            <x-badge class="send" color="blue" data-distribution="{{ $distribution->id }}">
                                                {{ __("Send") }}
                                            </x-badge>
                                        @elseif ($distribution->status === 'delivered')
                                            <x-badge color="green">
                                                {{ $distribution->status }}
                                            </x-badge>
                                        @else
                                            <x-badge>
                                                {{ $distribution->status }}
                                            </x-badge>
                                        @endif
                                    </x-table.td>
                                </tr>
                            @empty
                            @endforelse
                        </x-table.tbody>
                    </x-table.table>
                </x-white-block>
            </div>
             --}}
        </div>
        {{-- <div class="my-3">
            {{ $distributions->links() }}
        </div> --}}
    </x-slot>
    @section('script')
        <script>
            $('.imageCheckbox').change(function(){
                if ($(this).prop('checked')) {
                    $(this).closest('.imagePreview').find('img').addClass('opacity-40');
                }else{
                    $(this).closest('.imagePreview').find('img').removeClass('opacity-40');
                }
            });
            $('.send').click(function(){
                var button = $(this);
                var distribution = button.data('distribution');
                button.html(`Processing...`);
                button.removeClass('send');
                $.ajax({
                    url: "{{ url('/distribution') }}/"+distribution,
                    type: 'get',
                    cache: false,
                    success: function(data){
                        button.replaceWith(`<x-badge color="green">delivered</x-badge>`);
                        alert('done');
                    }.bind(button),
                    error: function(xhr, status, error) {
                        console.log("Ошибка сервера: " + error);
                    }
                });
            });
        </script>
    @endsection
    </x-layout>
