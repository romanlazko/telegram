@props(['_method' => '', 'method' => '', 'action' => ''])
<form method={{ $method }} action="{{ $action }}" {!! $attributes->merge(['class' => '']) !!}>
    @csrf
    @method($_method)
    
    <div class="space-y-6">
        {{ $slot }}
    </div>
</form>