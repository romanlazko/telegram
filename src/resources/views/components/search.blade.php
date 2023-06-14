<form method="get" action="{{ $action }}" class="w-full p-3">
    <div class="flex items-center justify-start space-x-3 w-full">
        <div class="flex-col w-full">
            <x-telegram::form.input id="search" name="search" type="text" class="w-full" :value="old('search', request()->search)" autocomplete="search" placeholder="Search"/>
        </div>
        <div class="flex-col">
            <x-telegram::buttons.primary>
                {{ __('Search') }}
            </x-telegram::buttons.primary>
        </div>
    </div>
</form>