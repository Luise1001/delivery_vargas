<div class="slider">
    <div class="type-order-title">Pago Móvil</div>
    @if ($mobile_payments)
        @foreach ($mobile_payments as $mobile)
            <div class="data-bank">
                <div class="card-list">
                    <div class="card-list-header">
                        <div class="card-list-title">
                            <i class="fa-solid fa-building-columns"></i>
                            {{$mobile->bank->name}}
                        </div>
                    </div>
                    <div class="list-data">
                        <div class="list-text"> {{$mobile->document_type.'-'.$mobile->document}} </div>
                        <div class="list-text"> {{$mobile->phone}} </div>
                    </div>
                    <div class="list-links">
                        <a href="{{route('data.bank.edit', ['type'=> 'mobile', 'id'=> 1])}}" class="list-link">Editar</a>
                        <form action="{{route('data.bank.delete')}}" method="post">
                          @csrf
                          @method("delete")
                          <input type="hidden" name="id" value="{{$mobile->id}}">
                          <input type="hidden" name="type" value="mobile">
                            <button class="list-link delete-bank">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
