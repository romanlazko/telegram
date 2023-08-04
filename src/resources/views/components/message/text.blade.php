@if ($message->callback_query?->data ?? $message->text ?? $message->caption )
    <div {{ $attributes->merge(['class' => 'shadow rounded-lg p-3 ']) }}>
        <p class="text-sm font-medium text-gray-500">
            {{ $message->callback_query?->user?->first_name ?? $message->user?->first_name}} {{ $message->callback_query?->user?->last_name ?? $message->user?->last_name}} 
        </p>
        <p>
            {!! nl2br(e( $message->callback_query?->data ?? $message->text ?? $message->caption)) !!}
        </p>
        <small title="{{ $message->created_at->format('d.m.Y (H:i:s)') }}">
            {{ $message->created_at->diffForHumans() }}
        </small>
    </div>
@endif
