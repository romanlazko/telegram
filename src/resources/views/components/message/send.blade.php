<form method="post" action="{{ $action }}" class="w-full p-3">
    @csrf
    @method('POST')
    <div class="flex items-center justify-start space-x-3 w-full">
        <div class="flex-col w-full">
            <x-telegram::form.input id="send_message" name="message" type="text" class="w-full" :value="old('message', request()->message)" autocomplete="message" placeholder="Write message"/>
        </div>
        <div class="flex-col">
            <x-telegram::buttons.primary>
                {{ __('Send') }}
            </x-telegram::buttons.primary>
        </div>
    </div>
</form>