<div class="slider">
    <div class="type-order-title">Transferencia</div>
    @if ($transfer_payments)
        @foreach ($transfer_payments as $transfer)
            <div class="data-bank">
                <div class="card-list">
                    <div class="card-list-header">
                        <div class="card-list-title">
                            <i class="fa-solid fa-building-columns"></i>
                            {{$transfer->bank->name}}
                        </div>
                    </div>
                    <div class="list-data">
                        <div class="list-text"> {{$transfer->document_type.'-'.$transfer->document}} </div>
                        <div class="list-text"> {{$transfer->account_number}} </div>
                    </div>
                    <div class="list-links">
                        <a href="{{route('data.bank.edit', ['type' => 'transfer', 'id'=> $transfer->id])}}" class="list-link">Editar</a>
                        <form action="{{route('data.bank.delete')}}" method="post">
                          @csrf
                          @method("delete")
                          <input type="hidden" name="id" value="{{$transfer->id}}">
                          <input type="hidden" name="type" value="transfer">
                            <button class="list-link delete-bank">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
