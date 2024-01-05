<div class="slider">
    <div class="type-order-title">Disponibles</div>
    <div id="available" class="products">

        @if ($available_products->count() > 0)
            @foreach ($available_products as $product)
                <div class="item-grid">
                    <div class="img-grid">
                        @if (!$product->photo)
                            @php
                                $photo = asset('assets/storage/products/generico.png');
                            @endphp
                        @else
                            @php
                                $commerce_id = $product->commerce_id;
                                $photo = asset("assets/storage/products/commerces/$commerce_id/products/" . $product->code . '.jpg');
                            @endphp
                        @endif
                        <img class="img-product" src="{{ $photo }}" class="card-img-top" alt="{{ $product->code }}">
                    </div>
                    <div class="item-grid-body">
                        <h5 class="item-grid-title">{{ $product->description }}
                            <span class="badge bg-success "> {{ $product->stock->quantity }}</span>
                        </h5>
                        <div class="item-grid-text">
                            <div class="item-price">${{ number_format($product->full_price, 2)}} </div>
                            <div class="item-tax">I.V.A ${{ number_format($product->full_price - $product->price, 2) }} </div>
                        </div>
                    </div>
                    <div class="button-grid">
                        <a href="{{route('commerce.product.edit', $product->id)}}" class="card-button">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="{{route('commerce.product.detail', $product->id)}}" class="card-button">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <form action="{{route('commerce.product.delete')}}" method="post">
                            @csrf
                            @method('DELETE')
                            <input hidden type="text" name="id" value="{{$product->id}}">
                            <button class="card-button delete-product" type="submit"> <i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="container-empty">
                <div class="alert empty-page" role="alert">
                    Sin productos para mostrar
                </div>
            </div>
        @endif

    </div>
</div>
