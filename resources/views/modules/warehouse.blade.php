<div class="card">
    <h3>Склад / ТМЦ</h3>
    @if(count($inventory))
        <ul>
            @foreach($inventory as $item)
                <li>{{ $item->name }} - в наличии: {{ $item->quantity }}
                    <form action="#" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Выдать сотруднику</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>Склад пуст.</p>
    @endif
</div>