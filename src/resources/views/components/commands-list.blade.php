@foreach ($commands as $command => $title)
    <option value="{{ $command }}">{{ $title }}</option>
@endforeach