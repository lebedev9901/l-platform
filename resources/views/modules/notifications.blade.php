<div class="card">
    <h3>Уведомления</h3>
    @if(count($notifications))
        <ul>
            @foreach($notifications as $note)
                <li>{{ $note->message }} ({{ $note->created_at->format('d.m.Y H:i') }})</li>
            @endforeach
        </ul>
    @else
        <p>Уведомлений нет.</p>
    @endif
</div>