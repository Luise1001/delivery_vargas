@extends("app.layouts.index")

@section("meta")
    <meta name="theme-color" content="#fce944" />
@endsection

@section("styles")
    <link rel="stylesheet" href="{{ asset("assets/css/buy/style.css") }}">
@endsection

@section("messages")
    @if (session()->has("success"))
        <div class="alert alert-success">
            {{ session()->get("success") }}
        </div>
    @endif
@endsection

@section("titulo-app")
    <div class="titulo-app">COMPRAR</div>
@endsection

@section("content")
    <div class="principal-layout">
        <div class="container-search">
            <input id="buscador" class="buscador" type="text" placeholder="Buscar Producto">
            <img class="icon-search" src="{{asset("assets/storage/icons/lupa.png")}}">
        </div>

        <div class="search-result"></div>

        <div class="advertisements">
            <div  class="carousel slide" data-bs-ride="carousel">
                <div id="publicidad" class="carousel-indicators">
                    <button type="button" data-bs-target="#publicidad" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#publicidad" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#publicidad" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#publicidad" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  </div>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="img-ads" src="{{asset("assets/storage/ads/option_1.png")}}" alt="promotion">
                    </div>
                    <div class="carousel-item">
                      <img class="img-ads" src="{{asset("assets/storage/ads/option_2.png")}}" alt="promotion">
                    </div>
                    <div class="carousel-item">
                      <img class="img-ads" src="{{asset("assets/storage/ads/option_3.png")}}" alt="promotion">
                    </div>
                    <div class="carousel-item">
                      <img class="img-ads" src="{{asset("assets/storage/ads/option_4.png")}}" alt="promotion">
                    </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#publicidad" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#publicidad" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                </div>
            </div>
  
        <div class="container container-categories">
            <h4 class="titulo-categorias">Categorías</h4>
            <div class="categories">
                @if($categories)
                    @foreach($categories as $category)
                    <div class="category-item">
                        <a href="{{route('buy.commerce.list', ['categoria' => $category->name, 'id'=> $category->id])}}"><img class="category-icon" 
                        src="{{asset("assets/storage/icons/services/$category->name.png")}}" alt="{{$category->name}}"></a>
                        <span class="category-span">{{$category->name}}</span>
                      </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="container container-products">
            <h4 class="titulo-categorias">Nuevos Productos</h4>
            <div class="new-products"></div>
        </div>
    </div>
@endsection

@section("javascripts")
@endsection
