<?php

$menu_comercio = 
'
<ul>
<div class="opciones">
<li>
<a class="sidebar-link" title="Mi Ubicación" href="../inicio/inicio">
<i class="fas fa-map-marker-alt"></i> Mi Ubicación
 </a>
</li>
</ul>
<ul>
<div class="opciones">
<li>
<a class="sidebar-link" title="Datos Personales" href="../comercios/mi_perfil">
   <i class="fas fa-id-card"></i> Mi Perfil
 </a>
</li>
<li>
<a class="sidebar-link" title="Mis Direcciones" href="../comercios/lista_de_direcciones">
<i class="fas fa-map-marker"></i> Mis Direcciones
 </a>
</li>
<li>
<a class="nav-link" title="Lista de Pedidos" href="../comercios/lista_de_pedidos">
<i class="fas fa-clipboard-list"></i> Mis Pedidos
</a>
</li>
  </div>
</ul>

<ul>
<div class="opciones dropdown">
  <a class="btn menu_opciones" title="Productos">
  <i class="fas fa-shopping-cart"></i> Productos
  </a>
     <div class="dropdown-container">
     <li>
     <a class="nav-link" data-toggle="modal" data-target="#nuevo_producto" title="Agregar un Nuevo Producto">
       <i class="fas fa-plus-circle"></i> Nuevo
     </a>
       </li>
       <li>
       <a class="sidebar-link" title="Mis Productos" href="../comercios/lista_de_productos">
         <i class="fas fa-list"></i> Mis Productos
        </a>
     </li>

      </div>
 </div>
</ul>

<ul>
<div class="opciones dropdown">
  <a class="btn menu_opciones" title="Finanzas">
  <i class="fas fa-dollar-sign"></i> Finanzas
  </a>
     <div class="dropdown-container">
     <li>
     <a class="nav-link" data-toggle="modal" data-target="#nuevo_datos_banco" title="Datos Bancarios">
       <i class="fas fa-plus-circle"></i> Datos Banco
     </a>
       </li>
       <li>
       <a class="sidebar-link" title="Métodos de pago" href="../comercios/mis_datos_bancarios">
         <i class="fas fa-list"></i> Datos Bancarios
        </a>
     </li>

      </div>
 </div>
</ul>
';