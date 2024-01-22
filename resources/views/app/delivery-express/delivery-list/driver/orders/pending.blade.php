<div class="slider">
    <div class="type-order-title">Pendientes</div>

    @if ($deliveryExpress->count() > 0)
        @foreach ($deliveryExpress as $delivery)
            @if ($delivery->status != 'Entregado' && $delivery->status != 'Cancelado')
                <div id="parent_{{ $delivery->id }}" class="card-list acordion">
                    <div class="card-list-header">
                        <strong class="me-auto">{{ $delivery->created_at->format('d/m/y') }} </strong>
                        <small> {{ $delivery->updated_at->format('d/m/y H:i:s') }} </small>
                    </div>
                    <div class="card-list-body">
                        <div class="list-img">
                            @if ($delivery->driver_id == true)
                                @php
                                    $id = $delivery->driver_id;
                                @endphp
                                <img class="img-list"
                                    src="{{ asset("assets/storage/profile/users/$id/photo/profile.jpg") }}"
                                    alt="Conductor">
                            @else
                                <img class="img-list" src="{{ asset('assets/storage/logos/deliveryvargas.png') }}"
                                    alt="Conductor">
                            @endif
                        </div>
                        <div class="list-data">
                            <div class="card-list-title" data-toggle="collapse" data-target="#child_{{ $delivery->id }}"
                                aria-expanded="true" aria-controls="child_{{ $delivery->id }}">
                                {{ $delivery->client->name . ' ' . $delivery->client->last_name }}
                            </div>
                            <div class="list-text">
                                <div>
                                    <span class="span-title">Precio:</span>
                                    ${{ number_format($delivery->amount, 2) }}
                                </div>
                                <div>
                                    <span class="span-title">Estado:</span>
                                    {{ $delivery->status }}
                                </div>
                                @if ($delivery->driver_id == true)
                                    <span class="span-title">Conductor:</span>
                                    <div>{{ $delivery->driver->name . ' ' . $delivery->driver->last_name }}</div>
                                @endif
                            </div>
                            <div class="list-links">
                                @if ($delivery->driver_id == false)
                                    <form action="{{ route('delivery.express.delete') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $delivery->id }}">
                                        <button type="submit" class="list-link delete-delivery">Cancelar</button>
                                    </form>
                                @endif
                                <a href="{{ route('delivery.express.detail', $delivery->id) }}"
                                    class="list-link">Detalle</a>
                                @if ($delivery->status == 'asignado')
                                    <a href="{{ route('delivery.express.accept', $delivery->id) }}"
                                        class="list-link">Aceptar
                                    </a>
                                @elseif($delivery->status == 'En camino')
                                    <a href="{{ route('delivery.express.delivered', $delivery->id) }}"
                                        class="list-link">Entregado
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                @else
                <div class="empty-page">No Hay Datos Para Mostrar</div>
            @endif
        @endforeach
    @else
        <div class="empty-page">No Hay Datos Para Mostrar</div>
    @endif
</div>
