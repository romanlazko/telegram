<datalist id="bot_commands_list">
    @foreach ($commands as $command => $title)
        <option value="{{ $command }}">{{ $title }}</option>
    @endforeach
</datalist>