<div class="slider">
    <div class="type-order-title">Completados</div>
    <div id="delivered">
        @if ($comercial->count() > 0)
            @foreach ($comercial as $delivery)
                @if ($delivery->status == 'Entregado')
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
                                <div class="card-list-title" data-toggle="collapse"
                                    data-target="#child_{{ $delivery->id }}" aria-expanded="true"
                                    aria-controls="child_{{ $delivery->id }}">
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
                                    <a href="{{ route('delivery.express.detail', $delivery->id) }}"
                                        class="list-link">Detalle</a>

                                </div>
                            </div>

                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <div class="empty-page">No hay Solicitudes pendientes</div>
        @endif
    </div>
</div>
