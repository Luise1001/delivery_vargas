<div class="slider">
    <div class="type-order-title">Pendientes</div>
    <div id="pending">
        @if (!$my_deliveries->count() > 0)
            @foreach ($my_deliveries as $delivery)
            @endforeach
        @else
            <div class="empty-page">No hay envios para mostrar</div>
        @endif
    </div>
</div>
