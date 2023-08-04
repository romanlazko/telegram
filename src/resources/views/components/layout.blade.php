<x-app-layout>
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-1 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    @if (isset($main))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                {{ $main }}
            </div>
        </div>
    @endif

    @if (session('ok') === true)
        <x-telegram::notifications.small class="bg-green-500" :title="session('description')"/>
    @elseif (session('ok') === false)
        <x-telegram::notifications.small class="bg-red-500" :title="session('description')"/>
    @endif

    @yield('script')
</x-app-layout>