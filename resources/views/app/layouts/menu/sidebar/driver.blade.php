<a class="sidebar-item" href=" {{ route("static.location.index") }}"><i class="fas fa-map-marker-alt"></i> Mis direcciones</a>

<a class="sidebar-item" href="../administradores/mis_envios"><i class="fas fa-motorcycle"></i> Deliveries</a>

<a class="sidebar-item mi-carrito" href="../administradores/mi_carrito"><i class="fas fa-shopping-cart"></i> 
Carrito <span class="badge car-badge bg-primary visually-hidden"></span></i></a>


{{-- <a class="sidebar-item" href="../inicio/informacion"><i class="fas fa-info"></i> Información</a>

<a class="sidebar-item" href="../inicio/terminos"><i class="fas fa-info-circle"></i> Políticas</i></a> --}}

<a class="sidebar-item" href="{{route("profile.reset.password")}}"><i class="fas fa-lock"></i> Cambiar Contraseña</a>

<a class="sidebar-item" href=" {{ route("app.logout") }} " id="cerrar_sesion"><i class="fas fa-sign-out-alt"></i> Salir</a>