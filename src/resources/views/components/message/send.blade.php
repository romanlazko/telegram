<form method="post" action="{{ $action }}" class="w-full p-3">
    @csrf
    @method('POST')
    <div class="flex items-center justify-start space-x-3 w-full">
        <div class="flex-col w-full space-y-2">
            <x-telegram::form.textarea id="send_message" name="message" type="text" class="w-full" :value="old('message', request()->message)" autocomplete="message" placeholder="Write message"/>
            <x-telegram::form.select name="commands[]" multiple class="w-full">
                <x-telegram::bot-commands-list :auth="request()->chat?->auth"/>
            </x-telegram::form.select>
        </div>
        <div class="flex-col">
            <x-telegram::buttons.primary>
                {{ __('Send') }}
            </x-telegram::buttons.primary>
        </div>
    </div>
</form>