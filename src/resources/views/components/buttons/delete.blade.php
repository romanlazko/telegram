@props(['id' => 'deleteButton', 'action' => ''])

<form method="POST" id="{{ $id }}" class="" action="{{$action}}">
    @csrf
    @method('delete')
    <button 
        {{ 
            $attributes->merge([
                'type' => 'submit', 
                'class' => 'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'
            ]) 
        }} 
        
        onclick="return confirm('{{ __('Are you shure?')}}')"
    >
        <i class="fa-solid fa-trash sm:mr-1"></i>
        <p class="hidden sm:block">
            {{ $slot }}
        </p>
    </button>
</form>