<div class="slider">
    <div class="type-order-title">Zelle</div>
    @if ($zelle_payments)
        @foreach ($zelle_payments as $zelle)
            <div class="data-bank">
                <div class="card-list">
                    <div class="card-list-header">
                        <div class="card-list-title">
                            <i class="fa-solid fa-building-columns"></i>
                            {{$zelle->owner_name}}
                        </div>
                    </div>
                    <div class="list-data">
                        <div class="list-text"> {{$zelle->email}} </div>
                    </div>
                    <div class="list-links">
                        <a href="{{route('data.bank.edit', ['type'=> 'zelle', 'id'=> $zelle->id])}}" class="list-link">Editar</a>
                        <form action="{{route('data.bank.delete')}}" method="post">
                          @csrf
                          @method("delete")
                          <input type="hidden" name="id" value="{{$zelle->id}}">
                          <input type="hidden" name="type" value="zelle">
                            <button class="list-link delete-bank">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
