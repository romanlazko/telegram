<x-telegram::layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create advertisement') }}
            </h2>
            <div class="flex-col">
                <x-telegram::a-buttons.secondary href="{{ route('advertisement.index') }}" class="float-right">
                    {{ __("←Back") }}
                </x-telegram::a-buttons.secondary>
            </div>
        </div>
    </x-slot>
    <x-slot name="main">
        <div class="sm:flex grid sm:grid-cols-2 grid-cols-1 sm:space-x-2 justify-between sm:space-y-0 space-y-6">
            <div class="flex-col max-w-xl w-full sm:w-1/2 ">
                <x-telegram::white-block>
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Create advertisement') }}
                    </h2>
            
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Use this form to create advertisement.') }}
                    </p>
                    <form method="post" action="{{ route('advertisement.store') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div>
                            <x-telegram::form.label for="name" :value="__('Name:*')" />
                            <x-telegram::form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus autocomplete="name" placeholder="Write name. User invisible"/>
                            <x-telegram::form.error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-telegram::form.label for="images" :value="__('Images:')" />
                            <input id="images" type="file" name="images[]" multiple="multiple" accept="image/*" max="9" class="mt-1 block w-full">
                            <x-telegram::form.error class="mt-2" :messages="$errors->get('images')" />
                        </div>

                        <div>
                            <x-telegram::form.label for="title" :value="__('Title:*')" />
                            <x-telegram::form.input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autocomplete="title" placeholder="Write title. User visible"/>
                            <x-telegram::form.error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                
                        <div>
                            <x-telegram::form.label for="description" :value="__('Description:*')" />
                            <x-telegram::form.textarea id="description" name="description" type="text" class="mt-1 block w-full" :value="old('description')" required autocomplete="description" rows="10" placeholder="Write description in MARKDOWN format. User visible"/>
                            <x-telegram::form.error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-telegram::form.label for="command" :value="__('Command:')" />
                            <x-telegram::form.input id="command" name="command" type="text" class="mt-1 block w-full" :value="old('command')" autocomplete="command" list="bot_commands_list" placeholder="Write command"/>
                            <datalist id="bot_commands_list">
                                <x-telegram::bot-commands-list/>
                            </datalist>
                            <x-telegram::form.error class="mt-2" :messages="$errors->get('command')" />
                        </div>

                        <div>
                            <x-telegram::form.label for="is_active" class="flex justify-start items-center">
                                <input name="is_active" class="hidden" value="0"/>
                                <x-telegram::form.input id="is_active" name="is_active" type="checkbox" class="mx-3 show-info" value="1"/>
                                {{__('Is active')}}
                            </x-telegram::form.label>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-telegram::buttons.primary>{{ __('Create') }}</x-telegram::buttons.primary>
                        </div>
                    </form>
                </x-telegram::white-block>
            </div>
        </div>
    </x-slot>
</x-telegram::layout>

