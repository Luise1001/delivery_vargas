<a class="sidebar-item" href=" {{ route("static.location.index") }}"><i class="fas fa-map-marker-alt"></i> Mis direcciones</a>

<a class="sidebar-item" href="{{route('delivery.index')}}"><i class="fas fa-motorcycle"></i> Deliveries</a>

<a class="sidebar-item mi-carrito" href=""><i class="fas fa-shopping-cart"></i> 
Carrito <span class="badge car-badge bg-primary visually-hidden"></span></i></a>

<a class="sidebar-item" href="{{route('commerce.list.index')}}"><i class="fas fa-building"></i> Comercios</a>

<a class="sidebar-item" href="{{route('user.list.index')}} "><i class="fas fa-users"></i> Usuarios</a>

<a class="sidebar-item" href=" {{route('driver.list.index')}} "><i class="fas fa-user-tie"></i> Conductores</a>

<a class="sidebar-item" href=" {{route('motorcycle.list.index')}}"><i class="fas fa-motorcycle"></i> Motos</a>

<a class="sidebar-item" href="{{route('fee.index')}}"><i class="fas fa-money-bill-alt"></i> Tarifas</a>


{{-- <a class="sidebar-item" href=""><i class="fas fa-info"></i> Información</a>

<a class="sidebar-item" href=""><i class="fas fa-info-circle"></i> Políticas</i></a> --}}

<a class="sidebar-item" href="{{route("profile.reset.password")}}"><i class="fas fa-lock"></i> Cambiar Contraseña</a>

<a class="sidebar-item" href=" {{ route("app.logout") }} " id="cerrar_sesion"><i class="fas fa-sign-out-alt"></i> Salir</a>