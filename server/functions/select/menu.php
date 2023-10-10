<?php

function menu()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $UserData = UserData($UserID);
    $UserName = $UserData[0]['User_name'];
    $respuesta = 
    [
        'header'=> HeaderMenu($AdminLevel),
        'titulo'=> 'Delivery Vargas',
        'foto'=> SearchProfilePhoto($UserID),
        'user'=> $UserName,
        'icons'=>'',
        'footer'=> FooterMenu($AdminLevel)
    ];

   echo json_encode($respuesta);
}

function HeaderMenu($AdminLevel)
{
  if($AdminLevel === '0')
  {
    $respuesta = 
    "
    <a class='sidebar-item' href='../clientes/lista_de_direcciones'><i class='fas fa-map-marker-alt'></i> Mis Direcciones</a>
    <a class='sidebar-item mi-carrito' data-toggle='modal' data-target='#ver_carrito'><i class='fas fa-shopping-cart'></i> 
              Carrito <span class='badge car-badge bg-primary visually-hidden'></span></i></a>
    <a class='sidebar-item' data-toggle='modal' data-target='#acerca_de'><i class='fas fa-info'></i> Información</a>
    <a class='sidebar-item' data-toggle='modal' data-target='#politicas'><i class='fas fa-info-circle'></i> Políticas</i></a>
    <a class='sidebar-item' id='reload' class=''><i class='fas fa-sync-alt'></i> Actualizar </a>
    <a class='sidebar-item' id='cerrar_sesion'><i class='fas fa-sign-out-alt'></i> Salir</a>
    ";
  }
  else if($AdminLevel === '1')
  {
    $respuesta =
    "
    <a class='sidebar-item' href='../administradores/lista_de_comercios'><i class='fas fa-building'></i> Comercios</a>
    <a class='sidebar-item' href='../administradores/lista_de_clientes'><i class='fas fa-users'></i> Clientes</a>
    <a class='sidebar-item' href='../administradores/lista_de_usuarios'><i class='fas fa-users'></i> Usuarios</a>
    <a class='sidebar-item' href='../administradores/lista_de_conductores'><i class='fas fa-user-tie'></i> Conductores</a>
    <a class='sidebar-item' href='../administradores/lista_de_motos'><i class='fas fa-motorcycle'></i> Motos</a>
    <a class='sidebar-item' href='../administradores/lista_de_tarifas'><i class='fas fa-money-bill-alt'></i> Tarifas</a>
    <a class='sidebar-item' href='../administradores/lista_de_administradores'><i class='fas fa-user-friends'></i> Administradores</a>
    <a class='sidebar-item' data-toggle='modal' data-target='#acerca_de'><i class='fas fa-info'></i> Información</a>
    <a class='sidebar-item' data-toggle='modal' data-target='#politicas'><i class='fas fa-info-circle'></i> Políticas</i></a>
    <a class='sidebar-item' id='reload'><i class='fas fa-sync-alt'></i> Actualizar </a>
    <a class='sidebar-item' id='cerrar_sesion'><i class='fas fa-sign-out-alt'></i> Salir</a>
    ";
     
  }
  else if($AdminLevel === '2')
  {
    $respuesta = 
    "
    <a class='sidebar-item' data-toggle='modal' data-target='#acerca_de'><i class='fas fa-info'></i> Información</a>
    <a class='sidebar-item' data-toggle='modal' data-target='#politicas'><i class='fas fa-info-circle'></i> Políticas</i></a>
    <a class='sidebar-item' id='reload'><i class='fas fa-sync-alt'></i> Actualizar </a>
    <a class='sidebar-item' id='cerrar_sesion'><i class='fas fa-sign-out-alt'></i> Salir</a>
    ";
  }
  else if($AdminLevel === '3')
  {
    $respuesta =
    "
    <a class='sidebar-item' href='../comercios/lista_de_direcciones'><i class='fas fa-map-marker-alt'></i> Mis Direcciones</a>
    <a class='sidebar-item' href='../comercios/mis_datos_bancarios'><i class='fas fa-dollar-sign'></i> Datos Bancarios</a>
    <a class='sidebar-item' data-toggle='modal' data-target='#acerca_de'><i class='fas fa-info'></i> Información</a>
    <a class='sidebar-item' data-toggle='modal' data-target='#politicas'><i class='fas fa-info-circle'></i> Políticas</i></a>
    <a class='sidebar-item' id='reload'><i class='fas fa-sync-alt'></i> Actualizar </a>
    <a class='sidebar-item' id='cerrar_sesion'><i class='fas fa-sign-out-alt'></i> Salir</a>
    ";
  }
  else if($AdminLevel === '4')
  {
     //administracion de gruas
  }
  else if($AdminLevel === '5')
  {
     //conductores de gruas
  }

  return $respuesta;
}

function FooterMenu($AdminLevel)
{
    $perfil = false;
    
    if($AdminLevel === '0')
    {
         $perfil = 'clientes';
    }
    else if($AdminLevel === '1')
    {
         $perfil = 'administradores';
    }
    else if($AdminLevel === '2')
    {
        $perfil = 'conductores';
    }
    else if($AdminLevel === '3')
    {
        $perfil = 'comercios';
    }
    else if($AdminLevel === '4')
    {
        //administradores de gruas
    }
    else if($AdminLevel === '5')
    {
         // conductores de gruas
    }

    if($perfil)
    {
        $respuesta = 
        "
        <a class='footer-icons' href='../$perfil/comprar'><i id='icon_shopping' class='fas fa-shopping-cart fa-2x'><span class='span-icon'>Comprar</span></i></a>
        <a class='footer-icons' href='../inicio/calculadora'><i id='icon_calculator' class='fas fa-calculator fa-2x'><span class='span-icon'>Calculadora</span></i></a>
        <a class='footer-icons' href='../$perfil/gruas'><i id='icon_home' class='fas fa-truck fa-2x'><span class='span-icon'>Grúas</span></i></a>
        <a class='footer-icons' href='../$perfil/lista_de_pedidos'><i id='icon_file' class='fas fa-file-alt fa-2x'><span class='span-icon'>Pedidos</span></i></a>
        <a class='footer-icons' href='../$perfil/mi_perfil'><i id='icon_profile' class='fas fa-user fa-2x'><span class='span-icon'>Perfil</span></i></a>
        ";

        return $respuesta;
    }
    else
    {
        return false;
    }
}