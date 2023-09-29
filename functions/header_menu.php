<?php
include_once 'conexion.php';

require 'global_functions/global_functions.php';
require 'users_menu/pc/menu_inferior.php';

if(isset($_SESSION['admin']))
{
  $id_usuario = UserID($_SESSION['admin']);
  $user_name = UserName($id_usuario);
  $nivel = AdminLevel($id_usuario);
  $checked = UserStatus($id_usuario, $nivel);

  if($nivel === '0')
  {
    include_once 'users_menu/smartphone/header/clientes.php';
     echo $menu_clientes;
  }

 if($nivel === '1')
 {
   include_once 'users_menu/smartphone/header/administradores.php';
   echo $menu_admin;
 }

 if($nivel === '2')
 {
  include_once 'users_menu/smartphone/header/conductores.php';
  echo $menu_conductores;
 }

 if($nivel === '3')
 {
   include_once 'users_menu/smartphone/header/comercios.php';
   echo $menu_comercio;
 }
 
}
else
{
  echo'<script type="text/javascript">
  window.location.href="../../index";
  </script>';
}



