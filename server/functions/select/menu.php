<?php

function menu()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $respuesta = 
    [
        'header'=> '',
        'titulo'=> 'Delivery Vargas',
        'icons'=>'',
        'footer'=> ''
    ];

    if($AdminLevel === '1')
    {
        $respuesta['header'] =
        "
        <li><a class='dropdown-itemn header-item' href='../administradores/lista_de_comercios'><i class='fas fa-building'></i> Comercios</a></li>
        <li><a class='dropdown-itemn header-item' href='../administradores/lista_de_clientes'><i class='fas fa-users'></i> Clientes</a></li>
        <li><a class='dropdown-itemn header-item' href='../administradores/lista_de_usuarios'><i class='fas fa-users'></i> Usuarios</a></li>
        <li><a class='dropdown-itemn header-item' href='../administradores/lista_de_conductores'><i class='fas fa-user-tie'></i> Conductores</a></li>
        <li><a class='dropdown-itemn header-item' href='../administradores/lista_de_motos'><i class='fas fa-motorcycle'></i> Motos</a></li>
        <li><a class='dropdown-itemn header-item' href='../administradores/lista_de_tarifas'><i class='fas fa-money-bill-alt'></i> Tarifas</a></li>
        <li><a class='dropdown-itemn header-item' href='../administradores/lista_de_administradores'><i class='fas fa-user-friends'></i> Administradores</a></li>
        <li><hr class='dropdown-divider'></li>
        <li><a class='dropdown-itemn header-item' data-toggle='modal' data-target='#acerca_de'><i class='fas fa-info'></i> Información</a></li>
        <li><a class='dropdown-itemn header-item' data-toggle='modal' data-target='#politicas'><i class='fas fa-info-circle'></i> Políticas</i></a></li>
        <li><a id='reload' class='dropdown-itemn header-item'><i class='fas fa-sync-alt'></i> Actualizar </a></li>
        <li><a id='cerrar_sesion' class='dropdown-itemn header-item' ><i class='fas fa-sign-out-alt'></i> Salir</a></li>
        ";

        $respuesta['footer'] =
        "
        <a href='../administradores/lista_de_envios'><i id='icon_motorcycle' class='fas fa-motorcycle fa-2x footer-icons'><span class='span-icon'>Envíos</span></i></a>
        <a href='../inicio/calcular_ruta'><i id='icon_calculator' class='fas fa-calculator fa-2x footer-icons'><span class='span-icon'>Rutas</span></i></a>
        <a href='../inicio/inicio'><i id='icon_home' class='fas fa-home fa-2x footer-icons'><span class='span-icon'>Inicio</span></i></a>
        <a data-toggle='modal' data-target='#tasa_del_dia'><i id='icon_coins' class='fas fa-coins fa-2x footer-icons'><span class='span-icon'>Tasa</span></i></a>
        <a href='../administradores/mi_perfil'><i id='icon_profile' class='fas fa-user fa-2x footer-icons'><span class='span-icon'>Perfil</span></i></a>
        ";
    }
    if($AdminLevel === '2')
    {
        $respuesta['header'] = 
        "
        <li><a class='dropdown-item' data-toggle='modal' data-target='#acerca_de'><i class='fas fa-info'></i> Información</a></li>
        <li><a class='dropdown-item' data-toggle='modal' data-target='#politicas'><i class='fas fa-info-circle'></i> Políticas</i></a></li>
        <li><hr class='dropdown-divider'></li>
        <li><a id='reload' class='dropdown-item'><i class='fas fa-sync-alt'></i> Actualizar </a></li>
        <li><a id='cerrar_sesion' class='dropdown-item' ><i class='fas fa-sign-out-alt'></i> Salir</a></li>";

        $respuesta['footer'] = 
        "
        <a href='../conductores/lista_de_envios'><i id='icon_motorcycle' class='fas fa-motorcycle fa-2x footer-icons'><span class='span-icon'>Envíos</span></i></a>
        <a href='../inicio/calcular_ruta'><i id='icon_calculator' class='fas fa-calculator fa-2x footer-icons'><span class='span-icon'>Rutas</span></i></a>
        <a href='../inicio/inicio'><i id='icon_home' class='fas fa-home fa-2x footer-icons'><span class='span-icon'>Inicio</span></i></a>
        <a href='../inicio/inicio'><i id='icon_map' class='fas fa-map-marker-alt fa-2x footer-icons'><span class='span-icon'>Ubicación</span></i></a>
        <a href='../conductores/mi_perfil'><i id='icon_profile' class='fas fa-user fa-2x footer-icons'><span class='span-icon'>Perfil</span></i></a>
        ";
    }
    if($AdminLevel === '0')
    {
        $respuesta['header'] = 
        "
        <li><a class='dropdown-item' href='../clientes/lista_de_direcciones'><i class='fas fa-map-marker-alt'></i> Mis Direcciones</a></li>
        <li><a class='dropdown-item mi-carrito' data-toggle='modal' data-target='#ver_carrito'><i class='fas fa-shopping-cart'></i> Carrito <span class='badge car-badge bg-primary visually-hidden'></span></i></a></li>
        <li><hr class='dropdown-divider'></li>
        <li><a class='dropdown-item' data-toggle='modal' data-target='#acerca_de'><i class='fas fa-info'></i> Información</a></li>
        <li><a class='dropdown-item' data-toggle='modal' data-target='#politicas'><i class='fas fa-info-circle'></i> Políticas</i></a></li>
        <li><a id='reload' class='dropdown-item'><i class='fas fa-sync-alt'></i> Actualizar </a></li>
        <li><a id='cerrar_sesion' class='dropdown-item' ><i class='fas fa-sign-out-alt'></i> Salir</a></li>
        ";

        $respuesta['footer'] = 
        "
        <a href='../clientes/comercios_by_categoria'><i id='icon_shopping' class='fas fa-shopping-cart fa-2x footer-icons'><span class='span-icon'>Comprar</span></i></a>
        <a href='../inicio/calcular_ruta'><i id='icon_calculator' class='fas fa-calculator fa-2x footer-icons'><span class='span-icon'>Rutas</span></i></a>
        <a href='../inicio/inicio'><i id='icon_home' class='fas fa-home fa-2x footer-icons'><span class='span-icon'>Inicio</span></i></a>
        <a href='../clientes/lista_de_pedidos'><i id='icon_file' class='fas fa-file-alt fa-2x footer-icons'><span class='span-icon'>Pedidos</span></i></a>
        <a href='../clientes/mi_perfil'><i id='icon_profile' class='fas fa-user fa-2x footer-icons'><span class='span-icon'>Perfil</span></i></a>
        ";
    }
    if($AdminLevel === '3')
    {
        $respuesta['header'] =
        "
        <li><a class='dropdown-item' href='../comercios/lista_de_direcciones'><i class='fas fa-map-marker-alt'></i> Mis Direcciones</a></li>
        <li><a class='dropdown-item' href='../comercios/mis_datos_bancarios'><i class='fas fa-dollar-sign'></i> Datos Bancarios</a></li>
        <li><hr class='dropdown-divider'></li>
        <li><a class='dropdown-item' data-toggle='modal' data-target='#acerca_de'><i class='fas fa-info'></i> Información</a></li>
        <li><a class='dropdown-item' data-toggle='modal' data-target='#politicas'><i class='fas fa-info-circle'></i> Políticas</i></a></li>
        <li><a id='reload' class='dropdown-item'><i class='fas fa-sync-alt'></i> Actualizar </a></li>
        <li><a id='cerrar_sesion' class='dropdown-item' ><i class='fas fa-sign-out-alt'></i> Salir</a></li>";
        $respuesta['footer'] = 
        "
        <a href='../comercios/lista_de_productos'><i id='icon_shopping' class='fas fa-shopping-cart fa-2x footer-icons'><span class='span-icon'>Productos</span></i></a>
        <a href='../inicio/calcular_ruta'><i id='icon_calculator' class='fas fa-calculator fa-2x footer-icons'><span class='span-icon'>Rutas</span></i></a>
        <a href='../inicio/inicio'><i id='icon_home' class='fas fa-home fa-2x footer-icons'><span class='span-icon'>Inicio</span></i></a>
        <a href='../comercios/lista_de_pedidos'><i id='icon_file' class='fas fa-file-alt fa-2x footer-icons'><span class='span-icon'>Pedidos</span></i></a>
        <a href='../comercios/mi_perfil'><i id='icon_profile' class='fas fa-user fa-2x footer-icons'><span class='span-icon'>Perfil</span></i></a>
        ";
    }

    echo json_encode($respuesta);
}