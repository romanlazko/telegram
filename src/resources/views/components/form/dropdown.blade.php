@props(['for'])


@if ($dorpdown) 
    <div x-data="{ {{$for}}: false }" class="relative dropdown">
        
        <input id="{{$for}}" {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!} @click="{{$for}} = ! {{$for}}">

        <div x-cloak x-show="{{$for}}" @click="{{$for}} = false" class="fixed inset-0 z-10 w-full h-full"></div>

        <div x-cloak x-show="{{$for}}" class="absolute left-0 z-10 mt-2 bg-white rounded-md shadow-xl border max-h-[200px] overflow-auto" id="{{$for}}Dropdown">
            
        </div>
    </div>

    <script>
        function setDropdownOption(id, value) {
            $("#"+id).val(value);
        }
        $('.option').click(function(){
            alert('option');
            $(this).parent('.dropdown').find('input').val($(this).val());
        });
    </script> 
@else 
    <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}">
@endif

