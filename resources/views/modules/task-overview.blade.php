<div class="card">
    <h3>Мои задачи</h3>
    @if(count($tasks))
        <ul>
            @foreach($tasks as $task)
                <li>
                    <strong>{{ $task->title }}</strong> - {{ $task->status }}
                    @if($task->status === 'не назначена')
                        <form action="{{ route('employee.tasks.take', $task->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Взять в работу</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p>Нет доступных задач.</p>
    @endif
</div>