<?php

$menu_admin =
'
<ul>
<li>
<a class="sidebar-link" title="Mi Ubicación" href="../inicio/inicio">
<i class="fas fa-map-marker-alt"></i> Mi Ubicación
</a>
</li>
<li>
<a class="nav-link" title="Mi Perfil" href="../administradores/mi_perfil">
<i class="fas fa-id-card"></i> Mi Perfil
</a>
</li>
<div class="opciones dropdown">
  <a class="btn menu_opciones" title="Zona de Clientes">
  <i class="fas fa-users"></i> Zona Clientes
  </a>
     <div class="dropdown-container">

     <li>
     <a class="nav-link" title="Lista de Comercios" href="../administradores/lista_de_comercios">
     <i class="fas fa-list"></i> Comercios
     </a>
   </li>
     <li>
     <a class="nav-link" title="Lista de Clientes" href="../administradores/lista_de_clientes">
     <i class="fas fa-list"></i> Clientes
     </a>
   </li>
   <li>
   <a class="nav-link" title="Lista de Usuarios" href="../administradores/lista_de_usuarios">
   <i class="fas fa-list"></i> Usuarios
   </a>
 </li>
</div>
 </div>
 <li>
<a class="nav-link" title="Lista de Envíos" href="../administradores/lista_de_envios">
<i class="fas fa-clipboard-list"></i> Envíos
</a>
</li>
</ul>
 
<ul>
<div class="opciones dropdown">
  <a class="btn menu_opciones" title="Conductores">
  <i class="fas fa-user-tie"></i> Conductores
  </a>
     <div class="dropdown-container">
     <li>
     <a class="nav-link" data-toggle="modal" data-target="#nuevo_conductor" title="Agregar un Nuevo Conductor">
       <i class="fas fa-plus-circle"></i> Nuevo
     </a>
       </li>
        <li>
          <a class="nav-link" title="lista de Conductores" href="../administradores/lista_de_conductores">
          <i class="fas fa-clipboard-list"></i> Activos
          </a>
        </li>

      </div>
 </div>
</ul>

<ul>
<div class="opciones dropdown">
  <a class="btn menu_opciones" title="Motos">
  <i class="fas fa-motorcycle"></i> Motos
  </a>
     <div class="dropdown-container">
     <li>
     <a class="nav-link" data-toggle="modal" data-target="#nueva_moto" title="Agregar una Nueva Moto">
       <i class="fas fa-plus-circle"></i> Nuevo
     </a>
   </li>
        <li>
          <a class="nav-link" title="lista de Motos" href="../administradores/lista_de_motos">
          <i class="fas fa-clipboard-list"></i> Activas
          </a>
        </li>
      </div>
 </div>
</ul>

<ul>
<div class="opciones dropdown">
  <a class="btn menu_opciones" title="Modulo Financiero">
  <i class="fas fa-dollar-sign"></i> Finanzas
  </a>
     <div class="dropdown-container">
        <li>
        <a class="nav-link" data-toggle="modal" data-target="#nueva_tarifa" title="Nueva Tarifa">
        <i class="fas fa-plus-circle"></i> Nueva Tarifa
        </a>
        </li>
      <li>
      <a class="nav-link" title="Tarifas" href="../administradores/lista_de_tarifas">
      <i class="fas fa-clipboard-list"></i> Tarifas
      </a>
    </li>

    <li>
    <a class="nav-link" data-toggle="modal" data-target="#tasa_del_dia" title="Nueva Tasa">
    <i class="fas fa-plus-circle"></i> Tasa del Dia
    </a>
    </li>
      </div>
 </div>
</ul>

<ul>
<div class="opciones dropdown">
  <a class="btn menu_opciones" title="Administradores">
  <i class="fas fa-user-cog"></i> Administradores
  </a>
     <div class="dropdown-container">
        <li>
          <a class="nav-link" data-toggle="modal" data-target="#nuevo_admin" title="Nuevo Administrador">
          <i class="fas fa-plus-circle"></i> Nuevo
          </a>
        </li>
        <li>
        <a class="nav-link" title="Lista de Administradores" href="../administradores/lista_de_administradores">
        <i class="fas fa-clipboard-list"></i> Administradores
        </a>
      </li>
      </div>
 </div>
</ul>
';