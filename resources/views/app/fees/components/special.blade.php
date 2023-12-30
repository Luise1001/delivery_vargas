<div class="slider">
    <div class="type-order-title">Tarifas Adicionales</div>
    <div class="feeds">
        @if ($fees)
            @foreach ($fees as $fee)
                @if ($fee->special)
                    <div class="card-list">
                        <div class="card-list-header">
                            <strong class="me-auto">{{ $fee->created_at->format('d/m/y') }} </strong>
                            <small>{{ $fee->updated_at->format('d/m/y H:i:s') }} </small>
                        </div>
                        <div class="card-list-body">
                            <div class="list-data">
                                <div class="card-list-title"> </div>
                                <div class="list-text">
                                    <div>De: {{ $fee->from }} Km.</div>
                                    <div>Hasta: {{ $fee->to }} Km.</div>
                                    <div>Precio:$ {{ $fee->price }} </div>
                                    <div class="list-links">
                                        <a href="{{route('fee.edit', $fee->id)}}" class="list-link">Editar</a>
                                        <form action="{{route('fee.delete')}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{$fee->id}}">
                                            <button class="list-link delete-fee">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</div>
