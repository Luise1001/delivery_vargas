<?php
include_once 'conexion.php';

require 'global_functions/global_functions.php';
require 'users_menu/pc/menu_inferior.php';

if(isset($_SESSION['admin']))
{
  $id_usuario = UserID($_SESSION['admin']);
  $user_name = UserName($id_usuario);
  $nivel = AdminLevel($id_usuario);

    if($nivel === '0')
    {
      include_once 'users_menu/pc/clientes.php';
       echo $menu_clientes;
    }

   if($nivel === '1')
   {
     include_once 'users_menu/pc/administradores.php';
     echo $menu_admin;
   }

   if($nivel === '2')
   {
    include_once 'users_menu/pc/conductores.php';
    echo $menu_conductores;
   }

   if($nivel === '3')
   {
     include_once 'users_menu/pc/comercios.php';
     echo $menu_comercio;
   }

    echo $menu_inferior;
  }
else
{
  echo'<script type="text/javascript">
  window.location.href="../../index";
  </script>';
}



