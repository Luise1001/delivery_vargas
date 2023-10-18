<?php

function menu()
{
    include_once '../conexion.php';
    $admin = $_SESSION['DLV']['admin'];
    $UserID = UserID($admin);
    $AdminLevel = AdminLevel($UserID);
    $UserData = UserData($UserID);
    $UserName = $UserData[0]['User_name'];

    if(isset($_POST['url']))
    {
       $url = $_POST['url'];
       $respuesta = 
       [
           'header'=> HeaderMenu($AdminLevel),
           'foto'=> SearchProfilePhoto($UserID),
           'user'=> $UserName,
           'footer'=> FooterMenu($AdminLevel, $url)
       ];

       echo json_encode($respuesta);
    }

}

function HeaderMenu($AdminLevel)
{
  if($AdminLevel === '0')
  {
    $respuesta = 
    "
    <a class='sidebar-item' href='../clientes/mis_direcciones'><i class='fas fa-map-marker-alt'></i> Mis Direcciones</a>
    <a class='sidebar-item mi-carrito' href='../clientes/mi_carrito'><i class='fas fa-shopping-cart'></i> 
              Carrito <span class='badge car-badge bg-primary visually-hidden'></span></i></a>
    <a class='sidebar-item' href='../inicio/informacion'><i class='fas fa-info'></i> Información</a>
    <a class='sidebar-item' href='../inicio/politicias'><i class='fas fa-info-circle'></i> Políticas</i></a>
    <a class='sidebar-item' href='../inicio/cambiar_clave'><i class='fas fa-lock'></i> Cambiar Contraseña</a>
    <a class='sidebar-item' id='cerrar_sesion'><i class='fas fa-sign-out-alt'></i> Salir</a>
    ";
  }
  else if($AdminLevel === '1')
  {
    $respuesta =
    "
    <a class='sidebar-item mi-carrito' href='../administradores/mi_carrito'><i class='fas fa-shopping-cart'></i> 
    Carrito <span class='badge car-badge bg-primary visually-hidden'></span></i></a>
    <a class='sidebar-item' href='../administradores/lista_de_comercios'><i class='fas fa-building'></i> Comercios</a>
    <a class='sidebar-item' href='../administradores/lista_de_clientes'><i class='fas fa-users'></i> Clientes</a>
    <a class='sidebar-item' href='../administradores/lista_de_usuarios'><i class='fas fa-users'></i> Usuarios</a>
    <a class='sidebar-item' href='../administradores/lista_de_conductores'><i class='fas fa-user-tie'></i> Conductores</a>
    <a class='sidebar-item' href='../administradores/lista_de_motos'><i class='fas fa-motorcycle'></i> Motos</a>
    <a class='sidebar-item' href='../administradores/lista_de_tarifas'><i class='fas fa-money-bill-alt'></i> Tarifas</a>
    <a class='sidebar-item' href='../administradores/lista_de_administradores'><i class='fas fa-user-friends'></i> Administradores</a>
    <a class='sidebar-item' data-toggle='modal' data-target='#acerca_de'><i class='fas fa-info'></i> Información</a>
    <a class='sidebar-item' data-toggle='modal' data-target='#politicas'><i class='fas fa-info-circle'></i> Políticas</i></a>
    <a class='sidebar-item' data-toggle='modal' data-target='#editar_clave'><i class='fas fa-lock'></i> Cambiar Contraseña</a>
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
    <a class='sidebar-item' data-toggle='modal' data-target='#editar_clave'><i class='fas fa-lock'></i> Cambiar Contraseña</a>
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
    <a class='sidebar-item' data-toggle='modal' data-target='#editar_clave'><i class='fas fa-lock'></i> Cambiar Contraseña</a>
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

function FooterMenu($AdminLevel, $url)
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
      $icon_comprar = '../../server/images/icons/menu/Ico_Compra_OFF.png';
      $icon_home = '../../server/images/icons/menu/Ico_Home_OFF.png';
      $icon_calculator = '../../server/images/icons/menu/Ico_Calculator_OFF.png';
      $icon_pedido = '../../server/images/icons/menu/Ico_Pedidos_OFF.png';
      $icon_perfil = '../../server/images/icons/menu/Ico_Perfil_OFF.png';

      if(strrpos($url, 'comprar'))
      {
        $icon_comprar = '../../server/images/icons/menu/Ico_Compra_ON.png';
      }
      if(strrpos($url, 'inicio'))
      {
        $icon_home = '../../server/images/icons/menu/Ico_Home_ON.png';
      }
      if(strrpos($url, 'calculadora'))
      {
        $icon_calculator = '../../server/images/icons/menu/Ico_Calculator_ON.png';
      }
      if(strrpos($url, 'pedido'))
      {
        $icon_pedido = '../../server/images/icons/menu/Ico_Pedidos_ON.png';
      }
      if(strrpos($url, 'perfil'))
      {
        $icon_perfil = '../../server/images/icons/menu/Ico_Perfil_ON.png';
      }
 
        $respuesta = 
        "
        <a class='footer-icons' href='../$perfil/comprar'>
        <img id='icon_compra' class='footer-icons' src='$icon_comprar'>
        </a>
        <a class='footer-icons' href='../inicio/calculadora'>
        <img id='icon_calculator' class='footer-icons' src='$icon_calculator'>
        </a>
        <a class='footer-icons' href='../inicio/inicio'>
        <img id='icon_home' class='footer-icons' src='$icon_home'>
        </a>
        <a class='footer-icons' href='../$perfil/mis_pedidos'>
        <img id='icon_pedido' class='footer-icons' src='$icon_pedido'>
        </a>
        <a class='footer-icons' href='../$perfil/mi_perfil'>
        <img id='icon_perfil' class='footer-icons' src='$icon_perfil'>
        </a>
        ";

        return $respuesta;
    }
    else
    {
        return false;
    }
}