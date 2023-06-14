@if ($reply_markup = json_decode($message->reply_markup) AND !$message->callback_query?->data)
    @foreach ($reply_markup as $vertical_lines)
        @foreach ($vertical_lines as $buttons)
            <div class="grid grid-cols-{{ count($buttons) }} text-center" >
                @foreach ($buttons as $button)
                    <div class="flex flex-col shadow sm:rounded-lg p-2 m-1 bg-gray-200" title="{{$button->callback_data ?? $button->url}}">
                        {{$button->text}}
                    </div>
                @endforeach
            </div>
        @endforeach
    @endforeach
@endif